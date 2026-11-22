<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    public function index()
    {
        return view('staff.index', ['staffMembers' => User::latest()->get()]);
    }

    public function create()
    {
        return view('staff.form', ['staff' => new User()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'alpha_dash', 'unique:users,username'],
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        User::create($data);

        return redirect()->route('staff.index')->with('success', 'Staff account added.');
    }

    public function show(User $staff)
    {
        return redirect()->route('staff.index');
    }

    public function edit(User $staff)
    {
        return view('staff.form', compact('staff'));
    }

    public function update(Request $request, User $staff)
    {
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'username' => [
                'required', 'string', 'max:50', 'alpha_dash',
                Rule::unique('users', 'username')->ignore($staff->id),
            ],
            'email' => [
                'nullable', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($staff->id),
            ],
            'password' => ['nullable', 'string', 'min:8'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        if ($request->hasFile('avatar')) {
            if ($staff->avatar) {
                Storage::disk('public')->delete($staff->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        } else {
            unset($data['avatar']);
        }

        $staff->update($data);

        return redirect()->route('staff.index')->with('success', 'Staff account updated.');
    }

    public function destroy(User $staff)
    {
        if ($staff->id === auth()->id()) {
            return back()->withErrors(['staff' => 'You cannot delete the account you are using.']);
        }

        if ($staff->avatar) {
            Storage::disk('public')->delete($staff->avatar);
        }

        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Staff account deleted.');
    }
}
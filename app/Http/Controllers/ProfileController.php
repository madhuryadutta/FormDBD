<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        exit(1);
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function userList()
    {
        $users = User::where('is_active', 1) // Only active users
            ->get();

        return view('users', compact('users'));
    }

    public function createuserView()
    {
        // Return a view for creating a new user
        return view('createuser');
    }

    public function createuser(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create new user record
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Hash password
        $user->save();

        // Optionally, you can log in the user here if needed

        // Redirect to a success page or wherever needed
        return redirect()->route('user.createview')->with('success', 'User created successfully');
    }

    public function editUser(User $user)
    {
        // You can optionally fetch additional data if needed
        return view('edituser', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        ]);

        // Update user record
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password); // Hash password if provided
        }
        $user->save();

        // Redirect to a success page or wherever needed
        return redirect()->route('user.edit', $user->id)->with('success', 'User updated successfully');
    }

    public function disableUser(User $user)
    {
        $user->is_active = false;
        $user->save();

        return redirect()->route('users.list')->with('success', 'User disabled successfully.');
    }

    public function makeAdmin(User $user)
    {
        $user->is_admin = true;
        $user->save();

        return redirect()->route('users.list')->with('success', 'User made admin successfully.');
    }

    public function removeAdmin(User $user)
    {
        $user->is_admin = false;
        $user->save();

        return redirect()->route('users.list')->with('success', 'Admin privileges removed successfully.');
    }
}

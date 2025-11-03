<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserManagementController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', 'role:admin']);
  }

  public function index()
  {
    $users = User::orderBy('created_at', 'desc')->paginate(20);
    return view('admin.users.index', compact('users'));
  }

  public function create()
  {
    // form to create admin or counter_manager
    return view('admin.users.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'fullname' => ['required', 'string', 'max:255'],
      'username' => ['required', 'string', 'max:50', 'alpha_dash', 'unique:users,username'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
      'role' => ['required', 'in:admin,counter_manager'],
      'father_name' => ['required', 'string', 'max:255'],
      'phone' => ['required', 'string', 'max:30'],
      'address' => ['required', 'string'],
      'nid_no' => ['required', 'string', 'max:100'],
      'profile_photo' => ['nullable', 'image', 'max:2048'],
    ]);

    $profilePath = null;
    if ($request->hasFile('profile_photo')) {
      $profilePath = $request->file('profile_photo')->store('profile_photos', 'public');
    }

    $user = User::create([
      'fullname' => $request->fullname,
      'username' => $request->username,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'role' => $request->role,
      'father_name' => $request->father_name,
      'phone' => $request->phone,
      'address' => $request->address,
      'nid_no' => $request->nid_no,
      'profile_photo_path' => $profilePath,
    ]);

    // return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    return redirect()->route('/')->with('success', 'User created successfully.');
  }

  public function edit(User $user)
  {
    return view('admin.users.edit', compact('user'));
  }

  public function update(Request $request, User $user)
  {
    $request->validate([
      'fullname' => ['required', 'string', 'max:255'],
      'username' => ['required', 'string', 'max:50', 'alpha_dash', 'unique:users,username,' . $user->id],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
      'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
      'role' => ['required', 'in:user,counter_manager,admin'],
      'father_name' => ['nullable', 'string', 'max:255'],
      'phone' => ['nullable', 'string', 'max:30'],
      'address' => ['nullable', 'string'],
      'nid_no' => ['nullable', 'string', 'max:100'],
      'profile_photo' => ['nullable', 'image', 'max:2048'],
      'status' => ['required', 'in:active,inactive'],
    ]);

    if ($request->hasFile('profile_photo')) {
      $user->profile_photo_path = $request->file('profile_photo')->store('profile_photos', 'public');
    }

    $user->fullname = $request->fullname;
    $user->username = $request->username;
    $user->email = $request->email;
    if ($request->filled('password')) {
      $user->password = Hash::make($request->password);
    }
    $user->role = $request->role;
    $user->father_name = $request->father_name;
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->nid_no = $request->nid_no;
    $user->status = $request->status;

    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'User updated.');
  }

  public function destroy(User $user)
  {
    $user->delete();
    return back()->with('success', 'User deleted.');
  }
}

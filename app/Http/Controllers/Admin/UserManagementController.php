<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserManagementController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', 'role:admin']);
  }

  public function admins()
  {
    $users = User::where('role', 'admin')->orderBy('created_at', 'desc')->paginate(20);
    return view('pages.admin.users.index-admin', [
      'users' => $users,
      'roleTitle' => 'Admins'
    ]);
  }

  public function controllers()
  {
    $users = User::where('role', 'controller')->orderBy('created_at', 'desc')->paginate(20);
    return view('pages.admin.users.index-controllers', [
      'users' => $users,
      'roleTitle' => 'Controller'
    ]);
  }

  public function counterManagers()
  {
    $users = User::with('counter')->where('role', 'counter_manager')->orderBy('created_at', 'desc')->paginate(20);
    return view('pages.admin.users.index-managers', [
      'users' => $users,
      'roleTitle' => 'Counter Managers'
    ]);
  }

  public function normalUsers()
  {
    $users = User::where('role', 'user')->orderBy('created_at', 'desc')->paginate(20);
    return view('pages.admin.users.index-users', [
      'users' => $users,
      'roleTitle' => 'Users'
    ]);
  }

  public function show(User $user)
  {
    $user->load('counter');
    return view('pages.admin.users.show', compact('user'));
  }

  public function create()
  {
    // form to create admin or counter_manager
    $counters = Counter::orderBy('name', 'asc')->get();
    return view('pages.admin.users.create', compact('counters'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'fullname' => ['required', 'string', 'max:255'],
      'username' => ['required', 'string', 'max:50', 'alpha_dash', 'unique:users,username'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
      'role' => ['required', 'in:admin,controller,counter_manager'],
      'father_name' => ['required', 'string', 'max:255'],
      'phone' => ['required', 'string', 'max:30'],
      'address' => ['required', 'string'],
      'nid_no' => ['required', 'string', 'max:100'],
      'counter_id' => ['nullable', 'integer'],
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
      'counter_id' => $request->counter_id,
      'profile_photo_path' => $profilePath,
    ]);

    // return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    return redirect()->route('dashboard.admin')->with('success', 'User created successfully.');
  }

  public function edit(User $user)
  {
    $counters = Counter::orderBy('name', 'asc')->get();
    return view('pages.admin.users.edit', compact('user', 'counters'));
  }

  public function update(Request $request, User $user)
  {
    $request->validate([
      'fullname' => ['required', 'string', 'max:255'],
      'username' => ['required', 'string', 'max:50', 'alpha_dash', 'unique:users,username,' . $user->id],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
      'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
      'role' => ['required', 'in:user,controller,counter_manager,admin'],
      'father_name' => ['nullable', 'string', 'max:255'],
      'phone' => ['nullable', 'string', 'max:30'],
      'address' => ['nullable', 'string'],
      'nid_no' => ['nullable', 'string', 'max:100'],
      'counter_id' => ['nullable', 'integer'],
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
    $user->counter_id = $request->counter_id;
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

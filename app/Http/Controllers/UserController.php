<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function index()
  {
    $users = User::with("role")
      ->latest()
      ->get();
    $roles = Role::all();
    return view("admin.tambah-user", compact("users", "roles"));
  }

  public function store(Request $request)
  {
    $request->validate([
      "name" => "required|string|max:255",
      "email" => "required|string|email|max:255|unique:users",
      "password" => "required|string|min:8",
      "role_id" => "required|exists:roles,id",
    ]);

    User::create([
      "name" => $request->name,
      "email" => $request->email,
      "password" => Hash::make($request->password),
      "role_id" => $request->role_id,
    ]);

    return redirect()
      ->back()
      ->with("success", "User berhasil dibuat!");
  }

  public function destroy($id)
  {
    $user = User::findOrFail($id);
    if ($user->id === auth()->id()) {
      return redirect()
        ->back()
        ->with("error", "Tidak bisa menghapus diri sendiri!");
    }

    $user->delete();
    return redirect()
      ->back()
      ->with("success", "User berhasil dihapus!");
  }
}

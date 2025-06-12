<?php

namespace App\Https\Controllers;

use Illuminate\Https\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        $kode_bl = Auth::user()->kode_bl ?? '';

        if ($role == 'admin') {
            $users = DB::table('users')->where('role', '!=', 'superadmin')->get();
        } else {
            $users = DB::table('users')->get();
        }

        return view('account', compact('role', 'kode_bl', 'users'));
    }

    public function addUser(Request $request)
    {
        \Log::info('addUser called with: ', $request->all());

        $validator = \Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
            'kode_booking' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            \Log::error('Validation failed: ', $validator->errors()->all());
            return redirect()->route('account.index')->withErrors($validator)->withInput();
        }

        $username = $request->input('username');
        $password = Hash::make($request->input('password'));
        $role = $request->input('role');
        $kode_booking = $request->input('kode_booking');
        $kode_bl = $role == 'customer' ? 'SSL' . substr($kode_booking, 3) : null;

        $existingUser = DB::table('users')->where('username', $username)->first();
        if ($existingUser) {
            \Log::error('Username already exists: ' . $username);
            return redirect()->route('account.index')->with('error', 'Username has already been taken.');
        }

        if ($role == 'customer' && empty($kode_booking)) {
            \Log::error('Kode booking is required for customer role.');
            return redirect()->route('account.index')->with('error', 'Kode booking is required for customer role.');
        }

        $result = DB::table('users')->insert([
            'username' => $username,
            'password' => $password,
            'role' => $role,
            'kode_booking' => $kode_booking,
            'kode_bl' => $kode_bl,
        ]);

        if ($result) {
            \Log::info('User created successfully: ' . $username);
            return redirect()->route('account.index')->with('message', 'User has been added successfully.');
        } else {
            \Log::error('Failed to create user: ' . $username);
            return redirect()->route('account.index')->with('error', 'Failed to add user.');
        }
    }

    public function deleteUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
        ]);

        $userId = $request->input('user_id');

        DB::table('users')->where('id', $userId)->delete();

        return redirect()->route('account.index')->with('message', 'User has been deleted successfully.');
    }
}

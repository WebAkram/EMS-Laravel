<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function postLogin(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect('indexdashboard');
            } elseif ($user->role === 'user') {
                return redirect()->route('user.index');
            }
        }
        $errors = ['credentials' => 'Oppes! You have entered invalid credentials'];
        return redirect()->back()->withInput()->withErrors($errors);
    }


    public function  Register(){
        return view('auth.register');
    }


            public function postRegistration(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
            ]);

            // Log in the user after registration
            Auth::login($user);

            return redirect()->route('user.index')->with('success', 'Great! You have successfully Login');
        }

        public function logout() {
            Session::flush();
            Auth::logout();
            return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');
        }

        public function  Adminprofile()
        {
          return view('admin.adminprofile');
        }
        public function Adminprofileupdate(Request $request)
        {
            $res = Auth::user();

            // Check if a new password is provided
            $newPassword = $request->input('new_password');
            $currentPassword = $request->input('current_password');

            // Check if current password is required when changing the password
            if (!empty($newPassword) && empty($currentPassword)) {
                return response()->json(['success' => false, 'passwordMismatch' => false, 'newPasswordRequired' => true, 'passwordNotChanged' => false]);
            }

            // Validate current password if a new password is provided
            if (!empty($newPassword) && !Hash::check($currentPassword, $res->password)) {
                return response()->json(['success' => false, 'passwordMismatch' => true, 'newPasswordRequired' => false, 'passwordNotChanged' => false]);
            }

            // Check if new password matches the current password
            if (!empty($newPassword) && Hash::check($newPassword, $res->password)) {
                return response()->json(['success' => false, 'passwordMismatch' => false, 'newPasswordRequired' => false, 'passwordNotChanged' => true]);
            }

            // Update the fields if provided
            if ($request->filled('new_username')) {
                $res->name = $request->input('new_username');
            }

            // Update the password only if a new password is provided
            if (!empty($newPassword)) {
                $res->password = Hash::make($newPassword);
            }
            // Save the changes
            $res->save();
            // Return success true along with the updated name in the JSON response
            return response()->json(['success' => true, 'newName' => $res->name]);
        }

        // Employee profile
        public function  Employeeprofile()
        {
          return view('employee.employeeprofile');
        }
        public function Employeeprofileupdate(Request $request)
        {
            $res = Auth::user();

            // Check if a new password is provided
            $newPassword = $request->input('new_password');
            $currentPassword = $request->input('current_password');

            // Check if current password is required when changing the password
            if (!empty($newPassword) && empty($currentPassword)) {
                return response()->json(['success' => false, 'passwordMismatch' => false, 'newPasswordRequired' => true, 'passwordNotChanged' => false]);
            }

            // Validate current password if a new password is provided
            if (!empty($newPassword) && !Hash::check($currentPassword, $res->password)) {
                return response()->json(['success' => false, 'passwordMismatch' => true, 'newPasswordRequired' => false, 'passwordNotChanged' => false]);
            }

            // Check if new password matches the current password
            if (!empty($newPassword) && Hash::check($newPassword, $res->password)) {
                return response()->json(['success' => false, 'passwordMismatch' => false, 'newPasswordRequired' => false, 'passwordNotChanged' => true]);
            }

            // Update the fields if provided
            if ($request->filled('new_username')) {
                $res->name = $request->input('new_username');
            }

            // Update the password only if a new password is provided
            if (!empty($newPassword)) {
                $res->password = Hash::make($newPassword);
            }
            // Save the changes
            $res->save();
            // Return success true along with the updated name in the JSON response
            return response()->json(['success' => true, 'newName' => $res->name]);
        }



}

<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        try {
            // Validasi input pengguna
            $validated = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                // 'phone_number'=>'required|string',

            ]);

            // Membuat user baru
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                // 'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),  // Hash password
                'role' => 'customer',
                // 'subscription_status' => 'Tidak Aktif',
                // 'points' => 0,
            ]);

            $customer = Customers::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Jika berhasil, kembalikan user dan pesan berhasil
            return response()->json([
                'message' => 'User registered successfully',
                'user' => $user
            ], 201);

        } catch (Exception $e) {
            // Menangkap error dan mengirimkan pesan error yang jelas
            return response()->json([
                'message' => 'Registration failed',
                'error' => $e->getMessage()  // Mengembalikan pesan error untuk debugging
            ], 500);
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LoginLog;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'message' => 'User baru berhasil didaftarkan!',
            'data' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json([
                'message' => 'Email atau password salah!'
            ], 401);
        }

        // Get user data
        $user = auth('api')->user();

        // Log login activity
        LoginLog::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'token' => $token,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'login_at' => now(),
            'expires_in' => auth('api')->factory()->getTTL() * 60, // convert ke detik
        ]);

        return $this->createNewToken($token);
    }

    public function profile(Request $request)
    {
        return response()->json([
            'message' => 'Profile retrieved successfully',
            'data' => auth('api')->user()
        ], 200);
    }

    public function logout()
    {
        $user = auth('api')->user();
        
        // Log logout activity - cari login log terakhir dan update logout_at
        if ($user) {
            LoginLog::where('user_id', $user->id)
                ->whereNull('logout_at')
                ->latest('login_at')
                ->first()
                ?->update([
                    'logout_at' => now(),
                ]);
        }

        auth('api')->logout();
        return response()->json([
            'message' => 'Logout berhasil'
        ], 200);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'message' => 'Login berhasil!',
            'data' => [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60,
                'user' => auth('api')->user()
            ]
        ], 200);
    }
}

<?php
namespace App\Services;

class AuthService
{
    public function check()
    {
        return session('auth');
    }
    public function auth()
    {
        session(['auth' => 1]);
    }
    public function logout()
    {
        session(['auth' => 0]);
    }
}

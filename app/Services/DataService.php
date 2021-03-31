<?php
namespace App\Services;

class DataService
{
    public function get()
    {
        return session('data', []);
    }
    public function set($data)
    {
        session(['data' => $data]);
    }
}

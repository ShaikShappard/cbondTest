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
        $data = collect($data)->filter(function ($value, $key) {
            return $value['name'] != 'Итого';
        });

        session(['data' => $data->all()]);
    }
}

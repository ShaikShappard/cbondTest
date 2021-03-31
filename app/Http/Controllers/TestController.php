<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Services\DataService;

class TestController extends Controller
{
    public function index(Request $request, AuthService $authService)
    {
        $tplData = [
            'auth' => $authService->check(), // флаг авторизации на сайте
        ];
        return view('index', $tplData);
    }

    public function auth(Request $request, AuthService $authService)
    {
        $authService->auth();
        return (redirect(route('index')));
    }

    public function logout(Request $request, AuthService $authService)
    {
        $authService->logout();
        return (redirect(route('index')));
    }

    public function export(Request $request, AuthService $authService)
    {
        dd('Функционал экспорта в Excel...');
    }

    public function get(Request $request, DataService $dataService)
    {
        $data = $dataService->get();
        return response()->json($data);
    }

    public function set(Request $request, DataService $dataService)
    {
        $data = $request->post('data', []);
        $dataService->set($data);
        return response()->json(['success' => true]);
    }
}

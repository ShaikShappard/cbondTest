<?php

namespace App\Http\Controllers;

use App\Exports\DataExport;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Services\DataService;

class TestController extends Controller
{

    /**
     * @param Request $request
     * @param AuthService $authService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, AuthService $authService)
    {
        $tplData = [
            'auth' => (bool)$authService->check(), // флаг авторизации на сайте
        ];
        return view('index', $tplData);
    }

    /**
     * @param Request $request
     * @param AuthService $authService
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function auth(Request $request, AuthService $authService)
    {
        $authService->auth();
        return (redirect(route('index')));
    }

    /**
     * @param Request $request
     * @param AuthService $authService
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request, AuthService $authService)
    {
        $authService->logout();
        return (redirect(route('index')));
    }

    /**
     * Экспорт даты в excel
     *
     * @param AuthService $authService
     * @param DataService $dataService
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(AuthService $authService, DataService $dataService)
    {
        return (new DataExport($dataService->get(), $authService->check()))
            ->download('data.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    /**
     * Получить data
     *
     * @param Request $request
     * @param DataService $dataService
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request, DataService $dataService)
    {
        $data = $dataService->get();
        return response()->json($data);
    }

    /**
     * сохранить data
     *
     * @param Request $request
     * @param DataService $dataService
     * @return \Illuminate\Http\JsonResponse
     */
    public function set(Request $request, DataService $dataService)
    {
        $data = $request->post('data', []);
        $dataService->set($data);
        return response()->json(['success' => true]);
    }
}

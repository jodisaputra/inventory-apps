<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        // Redirect based on role
        if ($user->hasRole('admin')) {
            return $this->adminDashboard();
        } elseif ($user->hasRole('store_admin')) {
            return $this->storeAdminDashboard();
        } else {
            return $this->userDashboard();
        }
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    private function adminDashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the store admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    private function storeAdminDashboard()
    {
        $store = auth()->user()->store;
        return view('store_admin.dashboard', compact('store'));
    }

    /**
     * Show the user dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    private function userDashboard()
    {
        return view('user.dashboard');
    }
}

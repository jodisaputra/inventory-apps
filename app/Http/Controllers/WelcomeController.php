<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
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
     * Show the welcome page for new users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // If user has seen welcome screen or has a store, redirect to dashboard
        if ($user->has_seen_welcome || $user->hasStore()) {
            return redirect()->route('dashboard');
        }

        return view('welcome');
    }

    /**
     * Handle the user's decision about creating a store.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeDecision(Request $request)
    {
        $user = $request->user();
        $createStore = $request->input('create_store', false);

        // Mark that user has seen welcome screen
        $user->has_seen_welcome = true;
        $user->save();

        if ($createStore) {
            return redirect()->route('stores.create');
        }

        return redirect()->route('dashboard');
    }
}

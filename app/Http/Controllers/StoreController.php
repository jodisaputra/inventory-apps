<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
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
     * Show the form for creating a new store.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        // Check if user already has a store
        if ($user->hasStore()) {
            return redirect()->route('stores.show', $user->store);
        }

        return view('stores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        // Check if user already has a store
        if ($user->hasStore()) {
            return redirect()->route('stores.show', $user->store)
                ->with('status', 'You already have a store!');
        }

        // Create store
        $store = new Store([
            'name' => $request->name,
            'user_id' => $user->id,
        ]);

        $store->save();

        // Assign store_admin role
        $user->assignRole('store_admin');

        return redirect()->route('stores.show', $store)
            ->with('status', 'Store created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        $user = auth()->user();

        // Check if user is admin or store owner
        if (!$user->hasRole('admin') && $store->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('stores.show', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        $user = auth()->user();

        // Check if user is admin or store owner
        if (!$user->hasRole('admin') && $store->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('stores.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        $user = auth()->user();

        // Check if user is admin or store owner
        if (!$user->hasRole('admin') && $store->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $store->name = $request->name;
        $store->save();

        return redirect()->route('stores.show', $store)
            ->with('status', 'Store updated successfully!');
    }
}

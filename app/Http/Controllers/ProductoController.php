<?php

namespace App\Http\Controllers;

use App\Events\ShowNotification;
use App\Notifications\GeneralNotifications;

use Illuminate\Http\Request;

class ProductoController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('producto.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $message = "{$request->user()->name} ha comprado ({$request->product})";

        // ? Enviamos la notificación con el método "notify"
        auth()->user()->notify( new GeneralNotifications(2, $message) );
        // ? Enviamos la notificación con el método "broadcast"
        broadcast( new ShowNotification(2, $request->all()) );
        
        return response()->json([
            'message' => 'Producto comprado'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }
}

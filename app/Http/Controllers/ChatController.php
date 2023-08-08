<?php

namespace App\Http\Controllers;

use App\Events\GreetingUser;
use App\Events\MessageSent;

use App\Models\User;

use Illuminate\Http\Request;

class ChatController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $context = [
            'userId' => auth()->id(),
        ];

        return view('chat.index', $context);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $data = $request->validate([
            'message' => 'required',
        ]);

        // ! Enviamos el mensaje a todos los usuarios conectados
        broadcast( new MessageSent( auth()->user(), $data['message'] ) )/* ->toOthers() */;

        return response()->json([
            'message' => 'Mensaje enviado',
        ]);
    }

    /**
     * Greet a user.
     */
    
    public function greet(Request $request) {
        $user = User::find($request->user_id);

        // ! Enviamos el mensaje a un usuario en específico
        broadcast( new GreetingUser( $user->id, "¡{$request->user()->name} te ha saludado!" ) )/* ->toOthers() */;
        broadcast( new GreetingUser( auth()->id(), "¡Saludaste a {$user->name}!" ) )/* ->toOthers() */;

        return response()->json([
            'message' => 'Saludo enviado',
        ]);
    }
}

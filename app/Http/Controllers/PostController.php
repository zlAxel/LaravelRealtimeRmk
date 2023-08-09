<?php

namespace App\Http\Controllers;

use App\Models\Comentario;

use Illuminate\Http\Request;

class PostController extends Controller {

    /**
     * Se crea constructor para validar autenticación
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Se crea método invocalbe para mostrar los comentarios
     */
    public function __invoke() {
        $context = [
            'comentarios' => Comentario::all(),
        ];
        return view('posts.index', $context);
    }
}

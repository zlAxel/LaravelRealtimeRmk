<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller {

    /**
     * Mostar todos los comentarios.
     */
    public function index() {
        // Retornamos todos los comentarios con los campos ( comentario, y el nombre del usuario que lo creo )
        return Comentario::with('user:id,name')->get(['comentario', 'user_id']);        
    }

    /**
     * Almacenamos un nuevo comentario.
     */
    public function store(Request $request) {
        // Creamos el comentario 
        $comment = Comentario::create($request->all());

        // Regresamos un arreglo con el comentario y el nombre del usuario que lo creo
        return [
            'comentario' => $comment->comentario,
            'usuario' => $comment->user->name,
        ];
    }

    /**
     * Eliminamos un comentario específico.
     */
    public function delete($comment) {
        // Buscamos el comentario
        $comment = Comentario::where('comentario', $comment)->firstOrFail();

        // Eliminamos el comentario
        $comment->delete();

        // Regresamos el comentario eliminado
        return $comment;
    }
}

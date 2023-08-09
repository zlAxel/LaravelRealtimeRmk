<?php

namespace App\Models;

use App\Events\CommentCreated;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model {
    use HasFactory;

    // ! Agregamos los fillable
    protected $fillable = [
        'post_id',
        'user_id',
        'comentario',
    ];

    // ? Ejecutamos los eventos de Laravel
    
    /**
     * The event map for the model.
     *
     * @var array<string, string>
     */
    
     protected $dispatchesEvents = [
        'created' => CommentCreated::class,
        // 'updated' => CommentUpdated::class,
        // 'deleted' => CommentDeleted::class,
    ];

    // ! Creamos la relacion de uno a muchos de usuarios
    public function user() {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
class Publicacion extends Model
{
    use SoftDeletes;

    protected $table = 'publicaciones';

    protected $fillable = [
        'user_id', 'titulo', 'contenido', 'estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

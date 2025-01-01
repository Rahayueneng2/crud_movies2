<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CastMovie extends Model
{
    use HasFactory;

    protected $table = 'cast_movies';

    protected $fillable = [
        'movie_id', 'cast_id'
    ];

    protected $keyType = 'string';

    public $incrementing = false;

    protected $casts = [
        'movie_id' => 'uuid',
        'cast_id' => 'uuid',
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function cast()
    {
        return $this->belongsTo(Cast::class);
    }
}

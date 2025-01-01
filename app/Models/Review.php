<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'review', 'rating', 'user_id', 'movie_id'
    ];

    protected $keyType = 'string';

    public $incrementing = false;

    protected $casts = [
        'id' => 'uuid',
        'rating' => 'integer',
        'user_id' => 'uuid',
        'movie_id' => 'uuid',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;
    protected $table='shows';
    protected $fillable = [
        'genre',
        'name',
        'duration',
        'country',
        'release_date',
        'description',
        'seasons',
        'url',
        'poster',
        'imdb_rating',
        'rotten_tomatoes'
    ];


    public function tvtime()
    {
        return $this->belongsTo(TvTime::class);
    }
    
}

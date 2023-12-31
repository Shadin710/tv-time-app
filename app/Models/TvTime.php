<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvTime extends Model
{
    use HasFactory;
    protected $table = 'tv_times';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function show()
    {
        return $this->hasMany(Show::class);
    }
}

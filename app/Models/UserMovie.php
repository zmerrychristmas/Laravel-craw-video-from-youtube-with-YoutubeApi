<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Movie;

class UserMovie extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'movie_id',
        'voted_status',
    ];

    CONST STATUS = [
        'arent_vote' => 0,
        'up_voted' => 1,
        'down_voted' => 2
    ];
}

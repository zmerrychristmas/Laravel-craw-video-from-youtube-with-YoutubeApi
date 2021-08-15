<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Movie;
use App\Models\UserMovie;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }

    public function votes()
    {
        return $this->hasMany(UserMovie::class);
    }

    public function movieInteraction($movie_id)
    {
        $result = $this->votes()
                ->where('movie_id', $movie_id)
                ->first();
        if ($result != null) {
            return $result->voted_status;
        }
        return $result;
    }

    public function movieVoteToogle($movie_id, $status)
    {
        $this->votes()
            ->where('movie_id', $movie_id)
            ->delete();
        return UserMovie::create([
            'user_id' => $this->id,
            'movie_id' => $movie_id,
            'voted_status' => $status
        ]);
    }
}

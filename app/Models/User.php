<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'avatar',
        'introduction',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    # To get all the categories of a user but only IDs
    public function categoryUser(){
        return $this->hasMany(CategoryUser::class);
    }

    # To get the categories with search result
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_user', 'user_id', 'category_id');
    }

    
    # To get the posts of a user
    public function posts(){
        return $this->hasMany(Post::class)->latest();
    }

    # To get the user's own communities
    public function communities(){
        return $this->hasMany(Community::class)->latest();
    }

    public function events(){
        return $this->hasMany(Event::class)->latest;
    }
}

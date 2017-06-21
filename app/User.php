<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'status', 'photo_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
      return $this->belongsTo(Role::class);
    }

    public function photo(){
      return $this->belongsTo(Photo::class);
    }

    public function posts(){
      return $this->hasMany(Post::class);
    }

    Public function isAdmin(){

      if($this->role->name == 'administrator' && $this->status == 1){
        return true;
      }

      return false;
    }

  Public function isAuthor(){

    if(($this->role->name == 'administrator' || $this->role->name == 'author') && $this->status == 1){
      return true;
    }

    return false;
  }
}

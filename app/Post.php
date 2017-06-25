<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Post extends Model
{
  use Sluggable;
  use SluggableScopeHelpers;

  protected $guarded = [];
  protected $primaryKey = 'id';

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function category(){
      return $this->belongsTo(Category::class);
    }

    public function photo(){
      return $this->belongsTo(Photo::class);
    }

    /*public function comments(){
      return $this->belongsToMany(Comment::class);
    }*/
  public function comments(){
    return $this->hasMany(Comment::class);
  }

  public function sluggable()
  {
    return [
      'slug' => [
        'source' => 'title',
        'separator' => '-',
        'includeTrashed' => true,
      ]
    ];
  }

  public function photoPlaceholder(){
    return "http://placehold.it/700x200";
  }

}

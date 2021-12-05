<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Laravel\Scout\Searchable;
use Illuminate\Notifications\Notifiable;

class Guides extends Model
{
    use HasFactory, Sluggable, Searchable,Notifiable;
    public $timestamps = false;
    protected $fillable = [
        'title',
        'category',
        'description',
        'content',
        'UserID'
        
    ];   
    public function sluggable(): array{
        return[
            'slug'=>[
                'source'=>'title'
            ]
        ];

    }
    public function User(){
        return $this->belongsTo(User::class);
    }
   
    public function Comment(){

        return $this->hasMany(comments::class);
    }
    

}

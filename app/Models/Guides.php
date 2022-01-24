<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Laravel\Scout\Searchable;
use Illuminate\Notifications\Notifiable;

use Cog\Contracts\Love\Reactable\Models\Reactable as ReactableInterface;
use Cog\Laravel\Love\Reactable\Models\Traits\Reactable;

class Guides extends Model implements ReactableInterface    
{
    use HasFactory, Sluggable, Searchable,Notifiable, Reactable;
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

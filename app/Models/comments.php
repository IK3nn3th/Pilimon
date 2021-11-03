<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class comments extends Model
{
    use HasFactory;

    public function UserComments(){

        return $this->belongsTo(User::class);
    }
    
    public function GuideComments(){
        return $this->belongsTo(Guides::class);
    }
}

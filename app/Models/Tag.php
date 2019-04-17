<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name','topic_count'];

    public function topic(){
        return $this->hasMany(Topic::class);
    }

}

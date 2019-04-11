<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\MustVerifyEmail as MVET;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use Notifiable,MVET;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','introduction','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**模型关联 一个用户 有多个话题  一对多
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topics(){
        return $this->hasMany(Topic::class);
    }

    /**一个用户可以拥有多条评论
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function isAuthOf($model){
        return $this->id == $model->user_id;
    }
    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }
}

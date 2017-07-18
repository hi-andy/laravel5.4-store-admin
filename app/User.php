<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected   $table          = 'merchant';  //表名
    protected   $primaryKey     = "id";    //定义用户表主键
    public      $timestamps     = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'merchant_name', 'email', 'password'
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
     * 更换加密方式，使用 MD5 方式加密
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = md5($password);
    }

    /**
     * 使用自定的用户名进行授权
     *
     * @param $username
     * @return mixed
     */
    public function findForPassport($username) {
        return $this->where('merchant_name', $username)->first();
    }
}

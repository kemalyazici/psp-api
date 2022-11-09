<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'apiKey'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ApiKey($email){
        $dec= sha1(md5($email."secret words from Kemal YAZICI".microtime()));
        $count=strlen($dec);
        $x = str_split($dec);
        $x1 = "";
        $a = 0;
        while($a<$count){
            if($a==8 OR $a==16 OR $a==24 OR $a==32){
                $x1 .= "-";
            }
            $x1 .= $x[$a];
            $a++;
        }
        $api = strtoupper($x1);
        return $api;

    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

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
        'id',
        'name',
        'username',
        'image',
        'referral_code'	,
        'role_id',
        'refer_id',
        'refer_code',
        'email',
        'password',
	    'remember_token',
        'is_verified',
        'email_verified_at',
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
        'password' => 'hashed',
    ];

    public function Transaction()
    {
        return $this->hasMany(Transaction::class,'user_id');
    }

    public function Transfer()
    {
        return $this->hasMany(Transfer::class,'user_id');
    }

    public static function tree()
    {
        $referUserId = Auth()->User()->id;
        $Allusers = User::where('id',$referUserId)->first();
        $rootUsers = $Allusers->whereNull('refer_id');
        foreach( $rootUsers as $rootUser ){
            $rootUser->children = $Allusers->where('refer_id', $rootUser->id);
        }
        return $rootUsers;
    }


    
}

<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;


#[Fillable([
    'admin_code',
    'name',
    'email',
    'password',
    'role_id',
    'phone',
    'institution',
    'status',
    'avatar',
    'created_by',
])]

#[Hidden([
    'password',
    'remember_token',
])]

class User extends Authenticatable
{

    use HasFactory, Notifiable;



    protected function casts(): array
    {
        return [

            'email_verified_at' => 'datetime',

            'password' => 'hashed',

        ];
    }




    protected static function boot()
    {

        parent::boot();


        static::creating(function ($user) {


            if (

                $user->role_id &&

                empty($user->admin_code)

            ) {


                $user->admin_code =
                    'ADM-' . strtoupper(Str::random(6));
            }
        });
    }




    /**
     * Relasi User ke Role
     */
    public function role()
    {

        return $this->belongsTo(Role::class);
    }





    /**
     * Admin yang membuat user
     */
    public function creator()
    {

        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }





    /**
     * User yang dibuat oleh admin ini
     */
    public function adminUsers()
    {

        return $this->hasMany(
            User::class,
            'created_by'
        );
    }
}

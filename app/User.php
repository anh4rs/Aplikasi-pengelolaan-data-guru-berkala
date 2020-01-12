<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'name', 'email', 'password', 'role', 'status',
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

    // cek role admin
    public function isAdmin() {
        if($this->role == 2) return true;
  
        return false;
    }

    public function berita()
    {
        return $this->HasMany('App\Berita');
    }

    public function karyawan()
    {
        return $this->HasOne('App\Karyawan');
    }

    public function sekolah()
    {
        return $this->HasOne('App\Sekolah');
    }
}

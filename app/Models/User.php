<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'namaLengkap',
        'username',
        'password',
        'role',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profiles()
    {
        return $this->hasOne(Profile::class, 'username', 'username');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'username', 'username');
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'username', 'username');
    }

    public function dpl()
    {
        return $this->hasOne(Dpl::class, 'username', 'username');
    }

    public function getTableDatabase()
    {
        if ($this->role == 'Admin') {
            return $this->admin;
        } elseif ($this->role == 'Mahasiswa') {
            return $this->mahasiswa;
        } elseif ($this->role == 'Dpl') {
            return $this->dpl;
        }
        return $this->admin;
    }
}

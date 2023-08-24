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
        'role'
    ];

    public function isSparePart()
    {
        return $this->role === 'SPARE PART';
    }

    public function isServiceManager()
    {
        return $this->role === 'SERVICE MANAGER';
    }

    public function isHeadOffice()
    {
        return $this->role === 'HEAD OFFICE';
    }
}

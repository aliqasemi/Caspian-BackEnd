<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens ,Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function getTable(): string
    {
        return 'users';
    }

    protected $fillable = [
        'firstname',
        'lastname',
        'phoneNumber',
        'address',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function transplantations(): HasMany
    {
        return $this->hasMany(Transplantation::class);
    }

    public function isSuperAdmin()
    {
        return $this->role === 'super-admin';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isAccess(string $role)
    {
        return $this->role === $role;
    }
}

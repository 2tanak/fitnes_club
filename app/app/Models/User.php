<?php

namespace App\Models;

use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'name',
        'phone',
        'blocked'
    ];

    protected static function boot()
    {
        parent::boot();
        //User::observe(UserObserver::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /*
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
    */

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

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

    function reply()
    {
        return $this->belongsTo(Reply::class, 'id', 'application_user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id');
    }

    public function hasRoles(array $roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return 1;
            }
        }
        return 0;
    }
}

<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

/* class User extends Authenticatable */
class User extends Authenticatable// implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    /* For Spatie - 28/03/2025 */
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'username',
        'password',
        'address',
        'type',
        'zipcode',
        'suspended_at',
        'last_login_at',
        'last_login_ip'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn(string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /* if user is suspended - call it in user list */
    public function suspendUser()
    {
        //$this->suspended_at = now();
        //$this->save();
        /* OR */
        $this->forceFill(['suspended_at' => $this->freshTimestamp()])->save();
    }
    public function unsuspendUser()
    {
        /* $this->suspended_at = NULL;
        $this->save(); */
        /* OR */
        $this->forceFill(['suspended_at' => NULL])->save();
    }

    public function isSuspended()
    {
        return $this->suspended_at ? true : false;
    }

    /* last login & last ip - called it in Login*/
    public function lastLoginUpdate()
    {
        $this->last_login_at = now();
        $this->last_login_ip = request()->ip();
        $this->save();
    }

    public function userDetail()
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'id');
    }
    
}

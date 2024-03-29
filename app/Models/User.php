<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Course;
use App\Models\Teller;
use App\Models\UserInformation;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\HasName;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail, FilamentUser, HasName {
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     * 
     */

    // public function users()
    // {
    //     return $this->hasMany(User::class, 'course_id');
    // }

     public function canAccessFilament(): bool
     {  

       

        return self::whereIn('email', ['admin@gmail.com', $this->email])->count() > 0;
        // return self::whereIn('email', ['admin@gmail.com'])->count() > 0;
        //  return str_ends_with('admin@gmail.com', '@gmail.com');
     }

     public function getFilamentName(): string
     {
         return "{$this->email}";
     }

    protected $fillable = [
       
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function userInformation()
    {
        return $this->hasOne(UserInformation::class, 'user_id');
    }

    public function course(){
        return $this->hasOne(Course::class, 'course_id');
    }
    
    public function roles(){
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }
    // public function teller(){
    //     return $this->hasOne(Teller::class, 'user_id');
    // }
}

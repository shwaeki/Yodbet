<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasFactory, HasRoles,ThrottlesLogins, LogsActivity,  SoftDeletes;


    protected $fillable = [
        'name', 'email', 'password', 'phone_number'];


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setStatusAttribute($status)
    {
        $this->attributes['status'] = ($status) ? 1 : 0;
    }

    public function setPasswordAttribute($password)
    {
        if (Hash::needsRehash($password)) {
            $password = Hash::make($password);
            $this->attributes['password'] = $password;
        }
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function workers()
    {
        return $this->hasMany(Worker::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(class_basename($this))
            ->dontLogIfAttributesChangedOnly(['updated_at', 'password'])
            ->logFillable()
            ->logOnlyDirty();
    }
}

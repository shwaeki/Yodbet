<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Client extends Model
{
    use HasFactory, LogsActivity,  SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'taxID',
        'client_key',
        'phone2',
        'city',
        'address',
        'added_by',
    ];


    public function projects()
    {
        return $this->hasMany(Project::class,'client_id');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class,'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'added_by');
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

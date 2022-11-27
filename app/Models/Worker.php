<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone1',
        'phone2',
        'hour_cost',
        'email',
        'identification',
        'status',
        'is_organizer',
        'organizer_id',
        'added_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'added_by');
    }

    public function Attendances()
    {
        return $this->hasMany(AttendanceDetails::class,'worker_id');
    }

    public function organizer()
    {
        return $this->belongsTo(Worker::class,'organizer_id');
    }

    public function workers()
    {
        return $this->hasMany(Worker::class,'organizer_id');
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

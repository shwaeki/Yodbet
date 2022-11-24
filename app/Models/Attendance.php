<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Attendance extends Model
{
    use HasFactory, LogsActivity,  SoftDeletes;

    protected $fillable = [
        'date',
        'status',
        'added_by',
        'project_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class,'added_by');
    }

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }

    public function attendances()
    {
        return $this->hasMany(AttendanceDetails::class,'attendance_id');
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

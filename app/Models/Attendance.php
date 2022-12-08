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
    protected $appends = ['total_hours'];

    protected $fillable = [
        'date',
        'status',
        'crane_id',
        'added_by',
        'project_id',
        'total_hours',
    ];


    public function user()
    {
        return $this->belongsTo(User::class,'added_by');
    }

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }

    public function crane()
    {
        return $this->belongsTo(Crane::class,'crane_id');
    }

    public function attendances()
    {
        return $this->hasMany(AttendanceDetails::class,'attendance_id');
    }


    public function getTotalHoursAttribute()
    {
        return $this->attendances->sum('hour_work_count');
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

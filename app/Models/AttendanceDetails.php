<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class AttendanceDetails extends Model
{

    use HasFactory,  SoftDeletes;

    protected $fillable = [
        'date',
        'hour_cost_project',
        'hour_cost_worker',
        'hour_work_count',
        'attendance_id',
        'worker_id',
    ];


    public function attendance()
    {
        return $this->belongsTo(Attendance::class,'attendance_id');
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class,'worker_id');
    }
}

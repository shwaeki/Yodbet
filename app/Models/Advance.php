<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Advance extends Model
{
    use HasFactory, LogsActivity,  SoftDeletes;

    protected $fillable = [
        'start_date',
        'payments',
        'status',
        'total',
        'worker_id',
        'added_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'added_by');
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class,'worker_id');
    }

    public function details()
    {
        return $this->hasMany(AdvanceDetails::class,'advance_id');
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

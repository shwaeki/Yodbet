<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class AdvanceDetails extends Model
{
    use HasFactory, LogsActivity,  SoftDeletes;

    protected $fillable = [
        'advance_id',
        'payment_date',
        'amount',
        'paid',
        'worker_id',
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class,'worker_id');
    }

    public function advance()
    {
        return $this->belongsTo(AdvanceDetails::class,'advance_id');
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

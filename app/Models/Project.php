<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Project extends Model
{
    use HasFactory, LogsActivity,  SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'start_date',
        'end_date',
        'hour_cost',
        'lat',
        'lng',
        'manager_id',
        'client_id',
    ];


    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }

    public function manager()
    {
        return $this->belongsTo(Contact::class,'manager_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class,'project_id');
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

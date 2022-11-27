<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Crane extends Model
{
    use HasFactory,  SoftDeletes;

    protected $fillable = [
        'name',
        'number',
        'project_id',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class,'crane_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }
}

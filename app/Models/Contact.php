<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Contact extends Model
{
    use HasFactory,  SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'job_title',
        'client_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class,'manager_id');
    }
}

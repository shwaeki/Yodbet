<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Post extends Model
{
    use LogsActivity, HasFactory, SoftDeletes;

    protected $fillable = [
        'post_title',
        'post_body',
        'featured_image',
        'status',
        'added_by',
    ];

    public function setStatusAttribute($status)
    {
        $this->attributes['status'] = ($status) ? 1 : 0;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(class_basename($this))
            ->dontLogIfAttributesChangedOnly(['updated_at'])
            ->logFillable()
            ->logOnlyDirty();
    }
}

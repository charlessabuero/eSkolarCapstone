<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Z3d0X\FilamentLogger\Resources\ActivityResource;


class RoleUser extends Model
{
    protected $table = 'model_has_roles';
    protected $fillable = ['role_id', 'model_id', 'model_type'];

    public $timestamps = false;
    
    public function model(): MorphTo
    {
        return $this->morphTo();
    }
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}

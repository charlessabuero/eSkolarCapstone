<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RequirementUser extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status','document','requirement_id','user_id','is_approved'];

    public function requirement(): BelongsTo
    {
        return $this->belongsTo(Requirement::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

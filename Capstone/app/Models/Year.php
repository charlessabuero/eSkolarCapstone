<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Year extends Model
{
    use HasFactory;
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['year'];

    public function academics() : HasMany
    {
        return $this->hasMany(Academic::class);
    }
    public function scopeGetAcademicYear($query,$year){
        return (Carbon::parse($year)->year) . ' - ' . (Carbon::parse($year)->addYear()->year);
    }
}

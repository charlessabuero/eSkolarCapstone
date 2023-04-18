<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Cache;

class Sponsor extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $with = [
        'scholars','scholarship_programs'
    ];
    protected $fillable = ['sponsor'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function scholarship_programs(): HasMany
    {
        return $this->hasMany(ScholarshipProgram::class);
    }
    public function scholars(): HasManyThrough
    {
        return $this->hasManyThrough(Scholar::class, ScholarshipProgram::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function (Sponsor $model) {
            Cache::forever('sponsor:' . $model->id, $model);

            Cache::forget('sponsors');
            Cache::forever('sponsors', Sponsor::all());
        });
        static::deleted(function (Sponsor $model) {
            Cache::forget('sponsor:' . $model->id);

            Cache::forget('sponsors');
            Cache::forever('sponsors', Sponsor::all());
        });
        static::updated(function (Sponsor $model) {
            Cache::forget('sponsor:' . $model->id);
            Cache::forever('sponsor:' . $model->id, $model);

            Cache::forget('sponsors');
            Cache::forever('sponsors', Sponsor::all());
        });
    }
}

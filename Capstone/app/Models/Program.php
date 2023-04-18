<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Program extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'abbre', 'college_id'];

    protected $with = [
        // "college",
        // "scholars"
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function college(): BelongsTo
    {
        return $this->belongsTo(College::class);
    }
    public function scholars(): HasMany
    {
        return $this->hasMany(Scholar::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function (Program $model) {
            Cache::forever('program:' . $model->id, $model);

            Cache::forget('programs');
            Cache::forever('programs', Program::all());
        });
        static::deleted(function (Program $model) {
            Cache::forget('program:' . $model->id);

            Cache::forget('programs');
            Cache::forever('programs', Program::all());
        });
        static::updated(function (Program $model) {
            Cache::forget('program:' . $model->id);
            Cache::forever('program:' . $model->id, $model);

            Cache::forget('programs');
            Cache::forever('programs', Program::all());
        });
    }
}

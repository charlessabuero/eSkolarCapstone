<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Cache;


class College extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $with = [
        'programs','scholars'
    ];
    protected $fillable = ['name','abbre'];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function programs() : HasMany{
        return $this->hasMany(Program::class);
    }
    public function scholars() : HasManyThrough{
        return $this->hasManyThrough(Scholar::class,Program::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function (College $model) {
            Cache::forever('college:' . $model->id, $model);

            Cache::forget('colleges');
            Cache::forever('colleges', College::all());
        });
        static::deleted(function (College $model) {
            Cache::forget('college:' . $model->id);

            Cache::forget('colleges');
            Cache::forever('colleges', College::all());
        });
        static::updated(function (College $model) {
            Cache::forget('college:' . $model->id);
            Cache::forever('college:' . $model->id, $model);


            Cache::forget('colleges');
            Cache::forever('colleges', College::all());
        });
    }
}

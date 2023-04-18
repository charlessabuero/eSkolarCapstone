<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Baranggay extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function (Baranggay $model) {
            Cache::forever('baranggay:' . $model->id, $model);

            Cache::forget('baranggays');
            Cache::forever('baranggays', Baranggay::all());
        });
        static::deleted(function (Baranggay $model) {
            Cache::forget('baranggay:' . $model->id);

            Cache::forget('baranggays');
            Cache::forever('baranggays', Baranggay::all());

        });
        static::updated(function (Baranggay $model) {
            Cache::forget('baranggay:' . $model->id);
            Cache::forever('baranggay:' . $model->id, $model);

            Cache::forget('baranggays');
            Cache::forever('baranggays', Baranggay::all());
        });
    }
}

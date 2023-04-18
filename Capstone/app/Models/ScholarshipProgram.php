<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class ScholarshipProgram extends Model
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
    protected $fillable = ['name','sponsor_id'];

    public function sponsor(): BelongsTo
    {
        return $this->belongsTo(Sponsor::class);
    }
    public function scholars(): HasMany
    {
        return $this->hasMany(Scholar::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function (ScholarshipProgram $model) {
            Cache::forever('scholarship_program:' . $model->id, $model);

            Cache::forget('scholarship_programs:pluck');
            Cache::forever('scholarship_programs:pluck', ScholarshipProgram::pluck('name','id'));
        });
        static::deleted(function (ScholarshipProgram $model) {
            Cache::forget('scholarship_program:' . $model->id);
            
            Cache::forget('scholarship_programs:pluck');
            Cache::forever('scholarship_programs:pluck', ScholarshipProgram::pluck('name','id'));
        });
        static::updated(function (ScholarshipProgram $model) {
            Cache::forget('scholarship_program:' . $model->id);
            Cache::forever('scholarship_program:' . $model->id, $model);
            
            Cache::forget('scholarship_programs:pluck');
            Cache::forever('scholarship_programs:pluck', ScholarshipProgram::pluck('name','id'));
        });
    }
}

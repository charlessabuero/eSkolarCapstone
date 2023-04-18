<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class Scholar extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = ['scholar_id','user_id', 'status', 'baranggay_id', 'scholarship_program_id', 'program_id', 'fname', 'lname'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function baranggay(): BelongsTo
    {
        return $this->belongsTo(Baranggay::class);
    }
    public function scholarship_program(): BelongsTo
    {
        return $this->belongsTo(ScholarshipProgram::class);
    }
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }
    public function college()
    {
        return $this->hasOneThrough(College::class, Program::class, 'id', 'id', 'program_id', 'college_id');
    }
    public function sponsor()
    {
        return $this->hasOneThrough(Sponsor::class, ScholarshipProgram::class, 'id', 'id', 'scholarship_program_id', 'sponsor_id');
    }
    public function scholarship_organization()
    {
        return $this->hasOneThrough(ScholarshipOrganization::class, ScholarshipOrganizationScholarshipProgram::class, 'scholarship_program_id', 'id', 'scholarship_program_id', 'scholarship_organization_id');
    }
    // public function scopeCanCreate($query, $id)
    // {
    //     $user = Cache::get('user:' . $id);
    //     return Module::manage(Module::level($user, Scholar::class));
    // }
    public function scopeTotalActiveScholar($query)
    {
        return $query->where('status', 3)->count();
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function (Scholar $model) {
            Cache::forever('scholar:' . $model->id, $model);

            if (Cache::has('scholar:status:' . $model->status . ':count'))
                Cache::increment('scholar:status:' . $model->status . ':count');
            else
                Cache::forever('scholar:status:' . $model->status . ':count', 0);

            Cache::forever('scholar:' . $model->id, $model);
        });
        static::deleted(function (Scholar $model) {
            if (Cache::has('scholar:status:' . $model->status . ':count'))
                Cache::decrement('scholar:status:' . $model->status . ':count');
            else
                Cache::decrement('scholar:status:' . $model->status . ':count');
            Cache::forget('scholar:' . $model->id, $model);

            Cache::forget('scholar:' . $model->id);
        });
        static::updated(function (Scholar $model) {
            Cache::forget('scholar:' . $model->id);

            Cache::forever('scholar:' . $model->id, $model);
        });
    }
}

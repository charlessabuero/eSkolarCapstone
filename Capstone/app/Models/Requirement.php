<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Requirement extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'filetypes' => 'array',
    ];
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

    public function filters()
    {
        return $this->morphMany(Filter::class, 'filterable');
    }
    protected $fillable = ['description', 'filetypes', 'academic_id', 'deadline', 'is_approved'];

    public function academic(): BelongsTo
    {
        return $this->belongsTo(Academic::class);
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot(['status', 'document']);
    }
    public function scopeCreateRequirement($query, $description, $filetypes, $deadline, $academic_id, $users)
    {

        $requirement = $query->firstOrCreate(
            [
                'description' => $description,
                'filetypes' => $filetypes,
            ],
            [
                'deadline' => $deadline,
                'academic_id' => $academic_id,
            ]
        );
        $requirement->users()->saveMany($users->get());
        return $requirement;
    }
    public function scopeGetAllRequirementsScholar($query, $user_id)
    {
        return $query->whereRelation('users', 'user_id', $user_id)
            ->whereRelation('academic', 'academics.id', Academic::currentYear()->first()->id);
    }
    public function scopeGetRequirements($query)
    {
        return $query->whereRelation('academic', 'academics.id', Academic::currentYear()->first()->id ?? []);
    }
}

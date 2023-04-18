<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Academic extends Model
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
    protected $fillable = ['year_id', 'semester_id', 'start', 'end', 'default', 'is_completed'];

    public function year(): BelongsTo
    {
        return $this->belongsTo(Year::class);
    }
    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    // Scopes
    public function scopeCurrentYear($query, $default = true)
    {
        return $query->where('default', $default);
    }
    public function scopeCreateAcademic($query, $year, $semester, $start, $end, $default = false)
    {
        $years = Year::firstOrCreate(['year' => Carbon::create($year)]);
        if (is_numeric($semester))
            $semesters = Semester::find($semester);
        else
            $semesters = Semester::firstOrCreate(['semester' => $semester]);
        return $query->firstOrCreate([
            'year_id' => $years->id,
            'semester_id' => $semesters->id
        ], [
            'start' => $start,
            'end' => $end,
            'default' => $default
        ]);
    }
    public function scopeSetDefaultAcademic($query, $id)
    {
        Academic::currentYear()->update(['default' => false]);
        $query->find($id)->update(['default' => true]);
    }
    public function scopeSetToComplete($query, $id)
    {
        $query->find($id)->update(['is_completed' => true]);
    }
    public function scopeGetAcademicID($query, $year, $semester)
    {
        $years = Year::firstwhere('year', Carbon::create($year));
        $semesters = Semester::firstWhere('semester', $semester);
        return $query
            ->where('year_id', $years->id)
            ->where('semester_id', $semesters->id)
            ->first()->id;
    }
}

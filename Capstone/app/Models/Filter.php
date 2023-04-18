<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Filter extends Model
{
    use HasFactory;
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'barangay_ids', 'sponsor_ids', 'scholarship_organization_ids',
        'scholarship_program_ids', 'college_ids', 'program_ids', 'scholar_statuses', 'filterable_id', 'filterable_type'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function filterable()
    {
        return $this->morphTo();
    }

    public function scopeCreateFilter($query, $data, $requirement, $class)
    {

        $filters = Filter::create([
            'barangay_ids' => implode(', ',$data['barangays']) ,
            'sponsor_ids' =>  implode(', ',$data['sponsors']),
            'college_ids' => implode(', ',$data['colleges']) ,
            'scholarship_organization_ids' => implode(', ',$data['scholarship_organizations']) ,
            'scholarship_program_ids' => implode(', ',$data['scholarship_programs']),
            'scholar_statuses' => implode(', ',$data['status']),
            'filterable_id'=> $requirement->id,
            'filterable_type'=> $class,
        ]);
        return $filters;
    }
}

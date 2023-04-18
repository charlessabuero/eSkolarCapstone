<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Trait\HasProfilePhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasOneDeep;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasApiTokens, HasFactory, Notifiable;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'contact_number',
        'avatar_url'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function canAccessFilament(): bool
    {
        return true;
        // return$this->hasVerifiedEmail();
    }
    public static function get_users()
    {
        return static::whereNot('role_id', Role::where('role', 'Scholar')->pluck('id', 'id'))
            ->whereNot('role_id', Role::where('role', 'Organization')->pluck('id', 'id'));
    }
    public function getFilamentAvatarUrl(): ?string
    {
        return '/storage/' . $this->avatar_url;
    }

    public function scholar(): HasOne
    {
        return $this->hasOne(Scholar::class);
    }
    public function scholarship_program(): HasOneThrough
    {
        return $this->hasOneThrough(ScholarshipProgram::class, Scholar::class, 'user_id', 'id', 'id', 'scholarship_program_id');
    }
    public function program(): HasOneThrough
    {
        return $this->hasOneThrough(Program::class, Scholar::class, 'user_id', 'id', 'id', 'program_id');
    }
    public function baranggay(): HasOneThrough
    {
        return $this->hasOneThrough(Baranggay::class, Scholar::class, 'user_id', 'id', 'id', 'baranggay_id');
    }
    public function role() : MorphOne
    {
        return $this->morphOne(RoleUser::class,'model');
    }
    public function college(): HasOneDeep
    {
        return $this->hasOneDeep(College::class, [Scholar::class, Program::class], ['user_id', 'id', 'id'], ['id', 'program_id', 'college_id']);
    }
    public function sponsor(): HasOneDeep
    {
        return $this->hasOneDeep(Sponsor::class, [Scholar::class, ScholarshipProgram::class], ['user_id', 'id', 'id'], ['id', 'scholarship_program_id', 'sponsor_id']);
    }
    public function scholarship_organization(): HasOneDeep
    {
        return $this->hasOneDeep(ScholarshipOrganization::class, [Scholar::class, ScholarshipOrganizationScholarshipProgram::class], ['user_id', 'scholarship_program_id', 'id'], ['id', 'scholarship_program_id', 'scholarship_organization_id']);
    }
    public function requirements(): BelongsToMany
    {
        return $this->belongsToMany(Requirement::class);
    }
    public function announcements(): BelongsToMany
    {
        return $this->belongsToMany(Announcement::class);
    }
    public function activity_logs(): HasMany
    {
        return $this->hasMany(Activity::class,'causer_id','id');
    }
    public function scopeIsAdmin($query)
    {
        return $query->where('role_id', Role::firstWhere('role', 'Admin')->id);
    }

    public function scopeCheckScholar($query, $user_id)
    {
        return $query->whereRelation('scholar', 'users.id', $user_id)->first() ? true : false;
    }
    public function scopeFilterScholars($query,$data)
    {
        $query = $query->whereHas('scholar');
        // Check if there is sponsors
        $query = $data['sponsors'] ? $query->{'whereRelation'}('sponsor', 'sponsors.id', $data['scholarship_programs']) : $query;

        // Check if there is scholarship programs
        $query = $data['scholarship_programs'] ? $query->{'whereRelation'}('scholarship_program', 'scholarship_programs.id', $data['scholarship_programs']) : $query;
        // Check if there is scholarship organization
        $query = $data['scholarship_organizations'] ? $query->{'whereRelation'}('scholarship_organization', 'scholarship_organizations.id', $data['scholarship_organizations']) : $query;

        // Check if there is programs
        $query = $data['programs'] ? $query->{'whereRelation'}('program', 'programs.id', $data['programs']) : $query;
        // Check if there is baranggay
        $query = $data['barangays'] ? $query->{'whereRelation'}('baranggay', 'baranggays.id', $data['barangays']) : $query;
        // Check if there is status
        $query = $data['status'] ? $query->{'whereRelation'}('scholar', 'scholars.status', $data['status']) : $query;

        return $query;
    }
}

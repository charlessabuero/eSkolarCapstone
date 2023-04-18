<?php

namespace App\Models;

use App\Events\RoleCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\support\Str;

class Role extends Model
{
    use HasFactory;

    public static function moduleName(): string
    {
        return Str::plural('Role');
    }
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
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function modules()
    {
        return $this->belongsToMany(Module::class)->withPivot('level');
    }
    public static function getRolesForUsersResource()
    {
        return static::whereNot([['name', '=', 'Scholar'], ['name', '=', 'Organization']])
            ->pluck('name', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function (Role $model) {
            Cache::forever('role:'.$model->name,$model);
            Cache::forever('role:'.$model->id,$model);
        });
        static::deleted(function (Role $model) {
            Cache::forget('role:'.$model->name);
            Cache::forget('role:'.$model->id);
        });
        static::updated(function (Role $model) {
            Cache::forget('role:'.$model->name);
            Cache::forget('role:'.$model->id);

            Cache::forever('role:'.$model->name,$model);
            Cache::forever('role:'.$model->id,$model);
        });
    }
}

<?php

namespace defyma\helper\LaraRbac\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 *
 * @package defyma\helper\LaraRbac\Models
 *
 * @author Andrey Girnik <girnikandrey@gmail.com>
 */
class Permission extends Model
{
    const ADMIN_PERMISSION = 'administrate';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'description',
    ];

    /**
     * Get roles by relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission', 'permission_id', 'role_id')->withTimestamps();
    }

    /**
     * Set name.
     * Set slug by name.
     *
     * @param $value
     *
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
        $this->attributes['slug'] = str_slug(strtolower($value));
    }
}

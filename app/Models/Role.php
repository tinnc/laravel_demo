<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function getRolesForDropdown()
    {
        return Role::pluck('name', 'parent_id')->toArray();
    }
}

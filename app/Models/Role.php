<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {

    const ROLE_ADMIN            = 1;
    const ROLE_MANAGER          = 2;
    const ROLE_CLIENT_MANAGER   = 3;

    protected $table = 'roles';
    protected $fillable = ['name', 'display_name', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
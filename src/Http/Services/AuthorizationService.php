<?php

namespace Prllxtchz\Authorization\Services;

class AuthorizationService
{
    /**
     * Exploding permission names to MODULE name and CRUD actions
     *
     * @param $permissions
     * @return array
     */
    public function getGroupedPermissions($permissions)
    {
        $permission_groups = [];

        foreach ($permissions as $permission) {
            $permission_expolded = explode(' ', $permission->name);
            $permission_group = $permission_expolded[1];

            $permission_groups[$permission_group][$permission_expolded[0]] = $permission->id;
        }

        return $permission_groups;
    }
}
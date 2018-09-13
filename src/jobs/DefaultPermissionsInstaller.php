<?php

namespace PrllxTchz\Authorization\Jobs;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class DefaultPermissionsInstaller
{
    public function create_default_permissions()
    {
        $default_modules = config('authorization.default_modules');

        // Looping through all modules and inserts in screens
        foreach ($default_modules as $default_module) {
            $module_id = $this->insert_module_data($default_modules['name'], $default_modules['order']);

            foreach ($default_module['screens'] as $screen) {
                $screen_id = $this->insert_screen_data($screen['name'], $screen['order'], $module_id);

                if ($screen['permissions'] === '*') {
                    $this->insert_all_permissions($screen_id, $screen['name']);
                } else {
                    $actions = explode('|', $screen['permissions']);

                    $this->insert_permissions($screen_id, $screen['name'], $actions);
                }

            }
        }
    }

    /**
     * Inserting all default permission in screen
     *
     * @param $screen_id
     * @param $screen_name
     */
    protected function insert_all_permissions($screen_id, $screen_name)
    {
        $default_actions = config('authorization.default_actions');

        foreach ($default_actions as $default_action) {
            $this->create_permission($default_action, $screen_name, $screen_id);
        }
    }

    /**
     * Inserting permission , action wise
     *
     * @param $screen_id
     * @param $screen_name
     * @param $actions
     */
    protected function insert_permissions($screen_id, $screen_name, $actions)
    {
        foreach ($actions as $action) {
            $this->create_permission($action, $screen_name, $screen_id);
        }
    }

    /**
     * Inserting Module table data
     *
     * @param $name
     * @param $order
     * @return int - module id last inserted
     */
    protected function insert_module_data($name, $order)
    {
        $module_id = DB::table('modules')->insertGetId([
            'name' => $name,
            'order' => $order,
        ]);

        return $module_id;
    }

    /**
     * Inserting screen data to the Screens Table
     *
     * @param $name
     * @param $order
     * @param $module_id
     * @return int - inserted screen id
     */
    protected function insert_screen_data($name, $order, $module_id)
    {
        $screen_id = DB::table('screens')->insertGetId([
            'name' => $name,
            'order' => $order,
            'module_id' => $module_id,
        ]);

        return $screen_id;
    }

    /**
     * Create single permission
     *
     * @param $action
     * @param $screen_name
     * @param $screen_id
     */
    private function create_permission($action, $screen_name, $screen_id)
    {
        Permission::create([
            'name' => $action . ' ' . $screen_name,
            'screen_id' => $screen_id,
        ]);
    }


}
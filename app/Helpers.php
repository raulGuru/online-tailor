<?php

if (!function_exists('get_roles')) {
    function get_roles($default = null)
    {
        $roles = array('admin', 'editor', 'contributor', 'viewer', 'billing', 'vendor', 'customer');
        
        if (is_numeric($default)) {
            return $roles[$default];
        }

        return $roles;
    }
}

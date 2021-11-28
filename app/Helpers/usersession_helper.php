<?php
if (!function_exists('isLoggedIn')) {
    function isLoggedIn()
    {
        $session = session();
        return $session->has('userdata');
    }
}
if (!function_exists('isAdminRole')) {
    function isAdminRole($role)
    {
        $session = session();
        if ($session->has('userdata')) {
            $userdata = $session->get('userdata');
            if ($userdata->role == $role) {
                return true;
            }
        }
        return false;
    }
}

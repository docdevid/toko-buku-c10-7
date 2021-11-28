<?php

if (!function_exists('getLatLng')) {
    function getLatLng($coordinate, $opsi)
    {
        $explode_coordinate = explode(',', $coordinate);
        return $opsi == 'lat' ? $explode_coordinate[0] : $explode_coordinate[1];
    }
}

if (!function_exists('getDefaultLatLng')) {
    function getDefaultLatLng()
    {
        return '-6.9962714780515265,110.42787711249545';
    }
}

if (!function_exists('getLat')) {
    function getDefaultLat()
    {
        return '-6.9962714780515265';
    }
}
if (!function_exists('getLng')) {
    function getDefaultLng()
    {
        return '110.42787711249545';
    }
}

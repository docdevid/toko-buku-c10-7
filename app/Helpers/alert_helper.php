<?php

if (!function_exists('alert')) {
    function alert($type = '', $msg = '', $title = '')
    {
        return '<div class="my-2"><div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">
                    ' . ($title != '' ? '<strong>' . $title . '</strong>' : '')  . ' ' . $msg . '
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                </div></div>';
    }
}

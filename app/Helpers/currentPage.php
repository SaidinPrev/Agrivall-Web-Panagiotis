<?php
if (!function_exists('setActivo')) {
    function setActivo($nombreRuta)
    {
        return request()->routeIs($nombreRuta) ? 'active' : '';
    }
}
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('isauthorized'))
{
function isauthorized()
{
    $CI =& get_instance();
    if(!$CI->session->userdata('isloggedin')){
        redirect('/account/login');
    }
    return true;
}
}
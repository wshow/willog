<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author: willin
 * Date: 12-11-10  上午12:00
 * Created by JetBrains PhpStorm.
 */

/**
 * Returns a boolean value based on whether the page was requested via AJAX or not
 *
 * @access	public
 * @return	boolean
 */
if ( ! function_exists('is_ajax'))
{
    function is_ajax(){
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest");
    }
}
if ( ! function_exists('array_insert'))
{
    function array_insert($myarray,$value,$position=-1){
        $fore=($position==0)?array():array_splice($myarray,0,$position);
        $fore[]=$value;
        $ret=($position==-1)?array_merge($myarray,$fore):array_merge($fore,$myarray);
        return $ret;
    }
}

if ( ! function_exists('array_delete'))
{
    function array_delete($myarray,$index=-1){
        array_splice($myarray,($index==-1)?$myarray.length-1:$index,1);
        return $myarray;
    }
}

if ( ! function_exists('uuid'))
{
    function uuid($prefix = '')
    {
        $chars = md5(uniqid(mt_rand(), true));
        $uuid = substr($chars,0,8) . '-';
        $uuid .= substr($chars,8,4) . '-';
        $uuid .= substr($chars,12,4) . '-';
        $uuid .= substr($chars,16,4) . '-';
        $uuid .= substr($chars,20,12);
        return $prefix . $uuid;
    }
}

if ( ! function_exists('valid_email'))
{
    function valid_email($address)
    {
        return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $address)) ? FALSE : TRUE;
    }
}
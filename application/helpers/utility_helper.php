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

if( ! function_exists('json_result') )
{
    function json_result($result){
        header('Content-Type: text/json');
        echo json_encode($result);
        exit();
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

if ( ! function_exists('is_json'))
{
    function is_json($str){
        return !is_null(json_decode($str,true));
    }
}

if( ! function_exists('encode_json'))
{
    function encode_json($str) {
        return urldecode(json_encode(url_encode($str)));
    }
}

if( ! function_exists('url_encode'))
{
    function url_encode($str) {
        if(is_array($str)) {
            foreach($str as $key=>$value) {
                $str[urlencode($key)] = url_encode($value);
            }
        } else {
            $str = urlencode($str);
        }

        return $str;
    }
}

if ( ! function_exists('is_mobile'))
{
    function is_mobile(){
        //正则表达式,批配不同手机浏览器UA关键词。
        $regex_match="/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220)/i";
        return isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE']) or preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT'])); //如果UA中存在上面的关键词则返回真。
    }
}

if( ! function_exists('deel_strimwidth'))
{
    //echo deel_strimwidth(strip_tags($str), 0, 125, '...');
    function deel_strimwidth($str ,$start , $width ,$trimmarker ){
        $output = preg_replace('/^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start.'}((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$width.'}).*/s','\1',$str);
        return $output.$trimmarker;
    }
}

if( ! function_exists('calc_distance'))
{

    function calc_distance($location,$lat,$lng){
        $latlng = explode(',',$location);
        $EARTH_RADIUS = 6378137.0;
        $f = getRad(($latlng[0] + $lat)/2);
        $g = getRad(($latlng[0] - $lat)/2);
        $l = getRad(($latlng[1] - $lng)/2);

        $sg = sin($g);
        $sl = sin($l);
        $sf = sin($f);

        $a = $EARTH_RADIUS;
        $fl = 1/298.257;

        $sg = $sg*$sg;
        $sl = $sl*$sl;
        $sf = $sf*$sf;

        $s = $sg*(1-$sl) + (1-$sf)*$sl;
        $c = (1-$sg)*(1-$sl) + $sf*$sl;

        $w = atan(sqrt($s/$c));
        $r = sqrt($s*$c)/$w;
        $d = 2*$w*$a;
        $h1 = (3*$r -1)/2/$c;
        $h2 = (3*$r +1)/2/$s;

        $distance = $d*(1 + $fl*($h1*$sf*(1-$sg) - $h2*(1-$sf)*$sg));
        if($distance>1000)
            return number_format($distance/1000, 2, '.', '').'KM';
        return number_format($distance, 2, '.', '').'M';

    }
}
if( ! function_exists('getRad'))
{
    function getRad($d){
        return $d*pi()/180.0;
    }
}
if( ! function_exists('create_geolocation'))
{
    function create_geolocation($lat,$lng,$tip){
        $html = '';
        if(isset($_COOKIE["location"])){
            $distance = calc_distance($_COOKIE["location"],$lat,$lng);

            $html = "<span>{$tip} <span>{$distance}</span>.</span>";
        }
        else
            $html = "<span class=\"hide\">{$tip} <span class=\"geolocation\" data-lat=\"{$lat}\" data-lng=\"{$lng}\">??</span>. </span> ";
        return $html;
    }
}
if( ! function_exists('create_map'))
{
    function create_map($lat,$lng){
        if($lat && $lng)
            return "<img src=\"http://maps.googleapis.com/maps/api/staticmap?center={$lat},{$lng}&zoom=13&size=600x300&maptype=roadmap&markers={$lat},{$lng}&scale=1&sensor=false\">";
        return '';
    }
}

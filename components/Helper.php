<?php namespace app\components;

/**
 * Helper.php
 *
 * @Author: Defy M Aminuddin <defyma> <http://defyma.com>
 * @Email:  defyma85@gmail.com
 * @Filename: Helper.php
 */

use Yii;
use yii\base\Component;

/**
 * Class Helper
 * @package app\components
 */
class Helper extends Component
{
    public static function validateUrl($link)
    {
        preg_match_all('#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si', $link, $result);
        return isset($result[0]) && !empty($result[0]) ? true : false;
    }

    public static function removeAllSpace($str)
    {
        return preg_replace('/\s+/', '', $str);
    }

    public static function removeSpecialChar($string)
    {
        return preg_replace('/[[:^print:]]/', '', $string);
    }

    public static function cleanParam($var)
    {
        $var = Helper::removeAllSpace($var);
        $var = Helper::removeSpecialChar($var);

        return $var;
    }

    public static function validateParam($arr = array())
    {
        foreach ($arr as $key => $val) {
            if ($val == "") {
                return [
                    'status' => 'error',
                    'message' => 'Parameter ' . $key . ' is empty!',
                ];
            }
        }

        return [
            'status' => 'success',
            'message' => '',
        ];
    }

    public static function getClientIP()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public static function encode($number) {
        return strtr(rtrim(base64_encode(pack('i', $number)), '='), '+/', '-_');
    }

    public static function decode($base64) {
        $number = unpack('i', base64_decode(str_pad(strtr($base64, '-_', '+/'), strlen($base64) % 4, '=')));
        return $number[1];
    }

    public static function getUniqueStringFromID($integer)
    {
        $base = 'SXhT9GA0guLwqm7z_Yne3vIZp5WJOb24kNa6B1M8EiCFPQfHxlrKtVURjcyD-sdo';

        $length = strlen($base);
        $out = "";
        while($integer > $length - 1)
        {
            $out = @$base[fmod($integer, $length)] . $out;
            $integer = floor( $integer / $length );
        }
        return @$base[$integer] . $out;
    }

}
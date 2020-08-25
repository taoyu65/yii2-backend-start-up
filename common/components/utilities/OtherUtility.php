<?php

namespace common\components\utilities;

use DOMDocument;
use ipip\db\Reader;
use Yii;

class OtherUtility
{
    /**
     * @return null | string
     */
    public static function getUserRealIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : NULL;
        }
        if (!$ip) {
            $ip = Yii::$app->getRequest()->getUserIP();
        }
        return $ip;
    }

    /**
     * @param string|int $ipMixString
     * @return string
     */
    public static function getIpFromLoginHistory($ipMixString)
    {
        # some record saved as integer and some are saved as string(ip4/ip6)
        if (ctype_digit($ipMixString)) {
            return long2ip($ipMixString);
        }

        return $ipMixString;
    }

    /**
     * @param $ip string
     * @return string|NULL
     * @throws \Exception
     */
    public static function getCountryByIp($ip)
    {
        $file_name = Yii::getAlias('@common') . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'ipiptest.ipdb';
        $db = new Reader($file_name);
        $info = $db->findMap($ip);
        $country = isset($info['country_name']) ? $info['country_name']: NULL;
        if( isset($info['region_name']) && $info['region_name']==='香港'){
            $country = '香港';
        }
        else if( isset($info['region_name']) && $info['region_name']==='澳门'){
            $country = '澳门';
        }
        else if( isset($info['region_name']) && $info['region_name']==='台湾'){
            $country = '台湾';
        }
        return $country;
    }

    /**
     * @return bool
     */
    public static function isIPv4FromChina()
    {
        $country_name = '';
        try{
            $ip = self::getUserRealIp();
            $country_name = self::getCountryByIp($ip);
        } catch (\Exception $e){}
        return $country_name==='中国';
    }

    /**
     * @return float|int
     */
    public static function getExpireTime()
    {
        return time() + 3600 * 24;
    }

    /**
     * @param int $min
     * @param int $max
     *
     * @return float|int
     */
    public static function randomFloat($min = 0, $max = 1)
    {
        return $min + mt_rand() / mt_getrandmax() * ($max - $min);
    }

    /**
     * @param string $content
     * @param string $className
     *
     * @return null|string|string[]
     */
    public static function addClassNameForImgTag($content, $className="img-responsive")
    {
        $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
        $document = new DOMDocument;
        libxml_use_internal_errors(true);
        $document->loadHTML(utf8_decode($content));
        $imgs = $document->getElementsByTagName('img');
        foreach ($imgs as $img) {
            $img->setAttribute('class', $className);
        }
        $html = $document->saveHTML();
        return $html;
    }
}
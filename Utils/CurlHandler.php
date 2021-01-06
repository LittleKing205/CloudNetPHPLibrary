<?php
namespace CloudNetLibrary\Utils;

class CurlHandler {
    
    /**
     * @param AuthHandler $auth
     * @param STRING $url
     * @param string $method
     * @param String[] $data
     */
    static function run($auth, $url, $method = "GET", $data = null) {
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_RETURNTRANSFER => 1,
        );
        if (!is_null($data))
            $options = array_replace($options, $data);
        $options = array_replace($options, $auth->getAuthData());
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        return $result;
    }
    
    static function auth($url, $data) {
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_RETURNTRANSFER => 1,
        );
        $options = array_replace($options, $data);
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        return $result;
    }
}


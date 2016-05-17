<?php
include_once("./_common.php");
require_once 'Instagram.php';
use MetzWeb\Instagram\Instagram;
 
getAccessToken();
 
function getAccessToken(){
    
        $url = "https://api.instagram.com/v1/subscriptions/";
        $access_token_parameters = array(
                'client_id'                =>     '51964c0b9b054942b59262d60dc5775d',
                'client_secret'            =>     '902a9502cfc44b9bb3919b91581e9893',
                'object'               =>     'tag',
                'aspect'             =>     'media',
                'object_id'                     =>     '아트쉐어',
                'callback_url'                     =>     'http://www.artshare.kr/insta/callback.php'
        );
        $curl = curl_init($url);    // we init curl by passing the url
        curl_setopt($curl,CURLOPT_POST,true);   // to send a POST request
        curl_setopt($curl,CURLOPT_POSTFIELDS,$access_token_parameters);   // indicate the data to send
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);   // to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);   // to stop cURL from verifying the peer's certificate.
        $result = curl_exec($curl);   // to perform the curl session
        curl_close($curl);   // to close the curl session

        $arr = json_decode($result,true);
print_r($arr);


}
?>
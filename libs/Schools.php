<?php
namespace app\libs;
use yii;

/**获取远程url数据
 * Class Schools
 * @package app\libs
 * by fawn
 */
class Schools {

    private $school_url;
    private $category_url;
    private $content_url;

    function __construct() {
        $this->school_url = Yii::$app->params['schoolUrl'];
        $this->category_url = Yii::$app->params['categoryUrl'];
        $this->content_url = Yii::$app->params['contentUrl'];
    }
    /**参数1：访问的URL，参数2：post数据(不填则为GET)，参数3：提交的$cookies,参数4：是否返回$cookies
     * @param $url
     * @param string $post
     * @param string $cookie
     * @param int $returnCookie
     * @return mixed|string
     * by fawn
     */
    function CurlRequest($url,$post='',$cookie='', $returnCookie=0){
        if(empty($url)){
            echo '非法操作';
            exit;
        }
        if($url == 'category'){
            $url = $this->category_url;
        }if($url == 'school'){
            $url = $this->school_url;
        }if($url == 'content'){
            $url = $this->content_url;
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)');
//        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_REFERER, "http://test.thinkwithu.com/cn/schools/index");
        if($post) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
        }
        if($cookie) {
            curl_setopt($curl, CURLOPT_COOKIE, $cookie);
        }
        curl_setopt($curl, CURLOPT_HEADER, $returnCookie);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        if (curl_errno($curl)) {
            return curl_error($curl);
        }
        curl_close($curl);
        if($returnCookie){
            list($header, $body) = explode("\r\n\r\n", $data, 2);
            preg_match_all("/Set\-Cookie:([^;]*);/", $header, $matches);
            $info['cookie']  = substr($matches[1][0], 1);
            $info['content'] = $body;
            return $info;
        }else{
            return $data;
        }
    }
}


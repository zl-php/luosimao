<?php
namespace Zl\Luosimao;

use Illuminate\Config\Repository;

class LuosimaoSms {

    protected $config = [];

    public function __construct(Repository $config)
    {
        $this->config = $config->get('sms');
    }

    /**
     * 发送单条短信 （验证码、触发类）
     *
     * @param $mobile
     * @param $message
     * @return mixed
     */
    public function send($mobile, $message)
    {
        $param = [
            'mobile' => $mobile,
            'message' => $message,
        ];

        $res = $this->post($this->config['send_url'], $param);

        return @json_decode($res, true);
    }

    /**
     * 批量发送短信
     *
     * @param array $mobile_list
     * @param $message
     * @param string $time
     * @return mixed
     */
    public function send_batch(array $mobile_list, $message, $time = '')
    {
        $mobile_list = is_array($mobile_list) ? implode(',', $mobile_list) : $mobile_list;

        $param = array(
            'mobile_list' => $mobile_list,
            'message' => $message,
            'time' => $time,
        );

        $res = $this->post($this->config['send_batch_url'], $param);
        return @json_decode($res, true);
    }

    /**
     * 查询账户余额
     *
     * @return mixed
     */
    public function getRemaining()
    {
        $res = $this->get($this->config['status_url']);
        return @json_decode($res, true);
    }


    /**
     * @param string $api_url
     * @param array $param
     * @param int $timeout
     * @return bool|string
     */
    private function post($api_url = '', $param = [], $timeout = 3)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);

        curl_setopt($ch, CURLOPT_HTTP_VERSION  , CURL_HTTP_VERSION_1_0 );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPAUTH , CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD  , 'api:key-' . $this->config['api_key']);

        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);

        $res = curl_exec( $ch );
        curl_close( $ch );

        return $res;
    }

    /**
     * @param string $api_url
     * @param int $timeout
     * @return bool|string
     */
    private function get($api_url = '', $timeout = 3)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL , $api_url);
        curl_setopt($ch, CURLOPT_HTTP_VERSION  , CURL_HTTP_VERSION_1_0 );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        curl_setopt($ch, CURLOPT_HTTPAUTH , CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD  , 'api:key-' . $this->config['api_key']);

        $res =  curl_exec( $ch );
        curl_close( $ch );

        return $res;
    }

}
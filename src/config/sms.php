<?php

return [

    /*
    |--------------------------------------------------------------------------
    | LUOSIMAO CONFIG
    |--------------------------------------------------------------------------
    |
    */

    'send_url'       => 'http://sms-api.luosimao.com/v1/send.json',
    'send_batch_url' => 'http://sms-api.luosimao.com/v1/send_batch.json',
    'status_url'     => 'http://sms-api.luosimao.com/v1/status.json',

    'api_key'        => env('LUOSIMAO_KEY', 'c03592e661b89cee0370001c814f8b84'),

];
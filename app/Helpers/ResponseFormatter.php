<?php

namespace App\Helpers;

/**
 * Format response.
 */

class ResponseFormatter
{

    /**
     * API Response
     *
     * @var array
     */
    protected static $response = [
        'meta' => [
            'code' => 200,
            'status' => 'success',
            'message' => null,
        ],
        'data' => [],
    ];

    /**
     * Give success response.
     */
    public static function success($data = null, $message = null,$type = 'array')
    {
        self::$response['meta']['message'] = $message;
        if($type == 'single'){
        self::$response['data'] = $data[0];
        }else if($type=="paginate"){
        self::$response['data'] = [...$data];
        self::$response['meta']['page'] = $data->currentPage();
        }else{
            self::$response['data'] = [...$data];
            }


        return response()->json(self::$response, self::$response['meta']['code']);
    }

    /**
     * Give error response.
     */
    public static function error($data = null, $message = null, $code = 400)
    {
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['code'] = $code;
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }
}

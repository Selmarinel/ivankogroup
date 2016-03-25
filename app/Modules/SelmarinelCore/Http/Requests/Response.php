<?php
namespace App\Modules\SelmarinelCore\Http\Requests;

use Illuminate\Http\Response as BaseResponse;

class Response extends BaseResponse {

    /**
     * @param string|array $errors
     * @param integer $status
     * @return \Illuminate\Http\Response
     */
    static function sendJsonWithErrors($errors = [], $status) {
        $status = (isset($status) && $status) ? $status : BaseResponse::HTTP_BAD_REQUEST;
        return self::sendJson(['errors' => $errors], $status);
    }

    /**
     * @param array $data
     * @param integer $status
     * @return \Illuminate\Http\Response
     */
    static function sendJson($data = [], $status) {
        $data['status'] = (isset($status) && $status) ? $status : BaseResponse::HTTP_OK;
        return new Response(json_encode($data, JSON_UNESCAPED_UNICODE), $data['status']);
    }
}
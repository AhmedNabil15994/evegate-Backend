<?php

namespace Modules\Apps\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ApiController extends Controller
{
    public function response($result, $message = 'Successfully')
    {
        $response = [
            'success' => true,
            'data' 		=> $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function error($error, $errorMessages = [], $code = 402)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function invalidData($error, $errorMessages = [], $code = 422)
    {
        $response = [
            'message' => 'The given data was invalid.',
            'errors' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function notFoundResponse($errorMessages = [], $code =404)
    {
        $response = [
            'success' => false,
            'message' => __("apps::api.not_found"),
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }




    public function responsePagnation($pagantion, $message = 'Successfully')
    {
        return $pagantion->additional(['success' => true, "message"=> $message]);
    }

    public function responsePagnationWithData($pagantion, $data=[], $message = 'Successfully')
    {
        $addation = array_merge(['success' => true, "message"=> $message], $data);
        return $pagantion->additional($addation);
    }

}

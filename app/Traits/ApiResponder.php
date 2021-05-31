<?php

namespace App\Traits;

trait ApiResponder
{


    function jsonSuccess($datas, $message = null, $code = 200)
    {

        return response()->json([
            'status' => 'success',
            'time' => now(),
            'message' => $message,
            'datas' => $datas
        ], $code);
    }

    function jsonById($id, $datas)
    {
        if ($datas) {
            return $this->jsonSuccess($datas);
        }
        return $this->jsonError('item : ' . $id . ' not found', 404);
    }


    function jsonError($message, $code)
    {

        return response()->json([
            'status' => 'error',
            'time' => now(),
            'message' => $message
        ], $code);
    }
}

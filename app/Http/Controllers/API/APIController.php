<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class APIController extends Controller
{
    protected function returnController($status, $data){
        if (!is_array($data) && json_decode($data) != null) {
            $data = json_decode($data);
        }
        return response()->json([
            'status' => $status,
            'data' => $data,
        ]);
    }
}

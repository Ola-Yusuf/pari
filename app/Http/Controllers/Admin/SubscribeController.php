<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;


class SubscribeController extends Controller
{

/**
     * Display a listing of the resource.
     *
     * @return json
     */
    public function submit(Request $request)
    {
        $rule = [
            'email' => 'required|email',
        ];
        $validation = Validator::make($request->all(), $rule);
        if($validation->fails()){
            return response()->json($validation->errors(), 400); 
        }
        $poll = Newsletter::create($request->all());
        return response()->json('submit successfully', 201);
    }

}
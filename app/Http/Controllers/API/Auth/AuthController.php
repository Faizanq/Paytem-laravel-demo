<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\Base\ApiController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends ApiController
{
    /**
     * Generate the token
     *
     * @return \Illuminate\Http\Response
     */
    
    public function login(Request $request)
    {
    	dd('dddd');
        
        return $this->SuccessResponse($result);
    }

}

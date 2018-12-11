<?php

namespace App\Http\Controllers\API\Token;

use App\Http\Controllers\API\Base\ApiController;
use App\Http\Controllers\Controller;
use App\Token;
use Illuminate\Http\Request;

class TokenController extends ApiController
{
    /**
     * Generate the token
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
    	$token = new Token;
    	$token->access_token = uniqid(base64_encode(str_random(60)));
    	$token->save();

    	$result['token'] = [];
    	$result['token']['access_token'] =  $token->access_token;
    	$result['token']['type'] =  'Bearer';
    	
        return $this->SuccessResponse($result);
    }

}

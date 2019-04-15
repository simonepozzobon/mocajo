<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TimeHunter\LaravelGoogleReCaptchaV3\Facades\GoogleReCaptchaV3;

class CaptchaController extends Controller
{
    public function verify(Request $request) {
        $response = GoogleReCaptchaV3::verifyResponse(
            $request->gRecaptchaResponse,
            $request->getClientIp()
        )->getMessage();
        return $response;
    }
}

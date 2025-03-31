<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientInformationRequest;

class ClientInformationController extends Controller
{
    //
    public function userInfo(ClientInformationRequest $request)
    {
        $clientInformation = $request->validated();

        dd($clientInformation);
    }
}

<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use App\Models\Order;
use App\Models\Property;
use App\Http\Controllers\Controller;
use App\Events\ClientInformationSubmitted;
use App\Http\Requests\ClientInformationRequest;

class ClientInformationController extends Controller
{
    //
    public function userInfo(ClientInformationRequest $request)
    {
        $clientInformation = $request->validated();

        $user = User::where('id', auth('web')->id())->first();

        $user->name = $clientInformation['fullName'];
        $user->email = $clientInformation['email'];
        $user->birthDate = $clientInformation['birthDate'];
        $user->mobileNumber = $clientInformation['mobileNumber'];
        $user->gender = $clientInformation['gender'];
        $user->occupation = $clientInformation['occupation'];
        $user->identityDocument = $clientInformation['identityDocument'];
        $user->idNumber = $clientInformation['idNumber'];
        $user->issueLocation = $clientInformation['issueLocation'];
        $user->expiryDate = $clientInformation['expiryDate'];
        $user->countryIssued = $clientInformation['countryIssued'];
        $user->issueAuthority = $clientInformation['issueAuthority'];
        $user->county = $clientInformation['county'];
        $user->subCounty = $clientInformation['subCounty'];
        $user->ward = $clientInformation['ward'];
        $user->postalCode = $clientInformation['postalCode'];
        $user->address = $clientInformation['address'];
        $user->town = $clientInformation['town'];
        $user->propertyId = $clientInformation['propertyId'];

        $user->save();

        $property = Property::where('propertyId', $user->propertyId)->first();

        $property->update([
            'acquisitionStatus' => 'Pending Approval',
        ]);

        $order = Order::create([
            'user_id' => $user->id,
            'property_id' => $property->id,
            'orderStatus' => 'active'
        ]);

        ClientInformationSubmitted::dispatch($user);

        return redirect()->route('client.notification');
    }
}

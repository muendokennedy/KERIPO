<?php

namespace App\Http\Controllers\Client;

use App\Events\ClientInformationSubmitted;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientInformationRequest;
use App\Models\Property;
use App\Models\User;

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
        $user->mobileNumber = $clientInformation['gender'];
        $user->gender = $clientInformation['occupation'];
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

        // $order = new Order;

        // $order->user_id = $user->id;
        // $order->propertyId = $user->propertyId;
        // $order->status = 'Pending Approval';

        // $order->save();

        ClientInformationSubmitted::dispatch($user);

        return back()->with('success', 'The property order information has been submitted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function clients()
    {
        $clients = Client::all();
        // dd($clients); // Dump data to verify
        return view('application.pages.clients.clients', ['clients' => $clients,'pageTitle' => 'អតិថិជន',]);
    }

    public function addClient()
    {
        return view('./application/pages/clients/add-client', ['pageTitle' => 'បន្ថែមអតិថិជន']);
    }

    public function saveClient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_Name' => 'required|max:255',
            'gender' => 'required',
            'phone_Number' => 'required|max:14',
            'address' => 'required',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1536000', // Made nullable if optional
            'card_ID' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1536000', // Made nullable if optional
        ], [
            'full_Name.required' => 'សូមបញ្ចូលឈ្មោះអ្នកប្រើប្រាស់។',
            'gender.required' => 'សូមជ្រើសរើសភេទអ្នកប្រើប្រាស់។',
            'phone_Number.required' => 'សូមបញ្ចូលលេខទូរស័ព្ទ។',
            'phone_Number.max' => 'លេខទូរស័ព្ទត្រូវមានយ៉ាងហោចណាស់ ១២ តួលេខទូរស័ព្ទ។',
            'address.required' => 'សូមបញ្ចូលអាសយដ្ឋាន។',
            'profile.image' => 'សូមជ្រើសរើសរូបភាពត្រឹមត្រូវសម្រាប់ Profile!',
            'card_ID.image' => 'សូមជ្រើសរើសរូបភាពត្រឹមត្រូវសម្រាប់ Card ID!',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'redirect' => null,
                'errors' => $validator->errors(),
            ], 422);
        }

        $client = new Client();
        $client->full_Name = $request->full_Name;
        $client->gender = $request->gender;
        $client->phone_Number = $request->phone_Number;
        $client->address = $request->address;

        if ($request->hasFile('profile')) {
            $imgProfile = time() . '.' . $request->file('profile')->getClientOriginalExtension();
            $request->file('profile')->move(public_path('/src/assets/uploads/clients/profile/'), $imgProfile);
            $client->profile = $imgProfile;
        }

        if ($request->hasFile('card_ID')) {
            $imgCardID = time() . '.' . $request->file('card_ID')->getClientOriginalExtension();
            $request->file('card_ID')->move(public_path('/src/assets/uploads/clients/card/'), $imgCardID);
            $client->card_ID = $imgCardID;
        }

        $client->save();
        session()->flash('success', 'បានបង្កើតអតិថិជនជោគជ័យ');
        return response()->json([
            'status' => true,
            'redirect' => route('application.pages.clients.clients'),
            'errors' => [],
        ]);
    }

    public function viewClient($id)
    {
        $client = Client::find($id);
        if($client == null) {
            abort(404);
        }
        return view('./application/pages/clients/view-client', ['client' => $client , 'pageTitle' => 'កែសម្រួលអតិថិជន '. $client->full_Name,]);
    }

    public function editClient($id)
    {
        $client = Client::find($id);
        if($client == null) {
            abort(404);
        }
        return view('./application/pages/clients/edit-client', ['client' => $client]);
    }

    public function updateClient(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'full_Name' => 'required|max:255',
            'gender' => 'required',
            'phone_Number' => 'required|max:14',
            'address' => 'required',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1536000', // Made nullable if optional
            'card_ID' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1536000', // Made nullable if optional
        ], [
            'full_Name.required' => 'សូមបញ្ចូលឈ្មោះអ្នកប្រើប្រាស់។',
            'gender.required' => 'សូមជ្រើសរើសភេទអ្នកប្រើប្រាស់។',
            'phone_Number.required' => 'សូមបញ្ចូលលេខទូរស័ព្ទ។',
            'phone_Number.max' => 'លេខទូរស័ព្ទត្រូវមានយ៉ាងហោចណាស់ ១២ តួលេខទូរស័ព្ទ។',
            'address.required' => 'សូមបញ្ចូលអាសយដ្ឋាន។',
            'profile.image' => 'សូមជ្រើសរើសរូបភាពត្រឹមត្រូវសម្រាប់ Profile!',
            'card_ID.image' => 'សូមជ្រើសរើសរូបភាពត្រឹមត្រូវសម្រាប់ Card ID!',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'redirect' => null,
                'errors' => $validator->errors(),
                'message' => 'មានបញ្ហា។',
            ], 422);
        }

        $client = Client::find($id);
        if(!$client){
            return response()->json([
                'status' => false,
                'redirect' => null,
                'message' => 'មិនមានអតិថិជននេះ។',
            ], 422);
        }

        $client->full_Name = $request->full_Name;
        $client->gender = $request->gender;
        $client->phone_Number = $request->phone_Number;
        $client->address = $request->address;

        if ($request->hasFile('profile') && $request->file("profile")->isValid()) {
            // Delete old image if exists
            if ($client->profile && file_exists(public_path('/src/assets/uploads/clients/profile/' . $client->profile))) {
                unlink(public_path('/src/assets/uploads/clients/profile/' . $client->profile));
            }

            // Upload new image
            $profile = $request->file("profile");
            $imgProfile = $id . '-' . time() . '.' . $profile->getClientOriginalExtension();
            $profile->move(public_path('/src/assets/uploads/clients/profile/'), $imgProfile);
            $client->profile = $imgProfile;
        }

        // Handle card_ID image update
        if ($request->hasFile('card_ID') && $request->file("card_ID")->isValid()) {
            // Delete old image if exists
            if ($client->card_ID && file_exists(public_path('/src/assets/uploads/clients/card/' . $client->card_ID))) {
                unlink(public_path('/src/assets/uploads/clients/card/' . $client->card_ID));
            }

            // Upload new image
            $card_ID = $request->file("card_ID");
            $imgCard = $id . '-' . time() . '.' . $card_ID->getClientOriginalExtension();
            $card_ID->move(public_path('/src/assets/uploads/clients/card/'), $imgCard);
            $client->card_ID = $imgCard;
        }

        $client->save();
        session()->flash('success', value: 'ការកែសម្រួលអតិថិជនរបស់អ្នកបានជោគជ័យ។');
        return response()->json([
            'status' => true,
            'redirect' => route('application.pages.clients.clients'),
            'errors' => [],
        ]);
    }

     public function deleteClient($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return redirect()->back()->with('error', 'អតិថិជនមិនមានក្នុងប្រព័ន្ធ។');
        }

        // Delete profile image if it exists
        if ($client->profile && file_exists(public_path('/src/assets/uploads/clients/profile/' . $client->profile))) {
            unlink(public_path('/src/assets/uploads/clients/profile/' . $client->profile));
        }

        // Delete card ID image if it exists
        if ($client->card_ID && file_exists(public_path('/src/assets/uploads/clients/card/' . $client->card_ID))) {
            unlink(public_path('/src/assets/uploads/clients/card/' . $client->card_ID));
        }

        // Delete the client record
        $client->delete();

        return redirect()->back()->with('success', 'អតិថិជនត្រូវបានលុបដោយជោគជ័យ។');
    }

}
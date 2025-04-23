<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function registation()
    {
        return view('./application/pages/auth/register');
    }

    public function processRegistration(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:4',
    ], [
        'name.required' => 'សូមបញ្ចូលឈ្មោះ។',
        'name.string' => 'ឈ្មោះត្រូវតែជាអក្សរ។',
        'name.max' => 'ឈ្មោះមិនអាចលើសពី ២៥៥ តួអក្សរទេ។',
        'email.required' => 'សូមបញ្ចូលអ៊ីម៉ែល។',
        'email.email' => 'អ៊ីម៉ែលមិនត្រឹមត្រូវ។',
        'email.unique' => 'អ៊ីម៉ែលនេះត្រូវបានប្រើប្រាស់រួចហើយ។',
        'password.required' => 'សូមបញ្ចូលលេខសម្ងាត់។',
        'password.string' => 'លេខសម្ងាត់ត្រូវតែជាអក្សរ។',
        'password.min' => 'លេខសម្ងាត់ត្រូវមានយ៉ាងហោចណាស់ ៤ តួអក្សរ។',
    ]);

    if ($validator->passes()) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        // Flash success message to session
        session()->flash('success', 'អ្នកបានចុះឈ្មោះប្រើប្រាស់ដោយជោគជ័យ');

        return response()->json([
            'status' => true,
            'redirect' => route('application.pages.auth.login'),
            'errors' => []
        ]);
    } else {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }
}

    public function login()
    {
        return view('./application/pages/auth/login');
    }

    public function authenticate(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'សូមបញ្ចូលអ៊ីម៉ែល។',
            'email.email' => 'អ៊ីម៉ែលមិនត្រឹមត្រូវ។',
            'password.required' => 'សូមបញ្ចូលលេខសម្ងាត់។',
        ]);

        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('application.pages.dashboard')->with("success", "សូមស្វាគមន៍ការចូលរបស់អ្នកដោយជោគជ័យ។");
            } else {
                return redirect()->route('application.pages.auth.login')->with("error", "ទាំងអ៊ីមែលឬលេខសម្ងាត់មិនត្រឹមត្រូវ?");
            }
        } else {
            return redirect()->route('application.pages.auth.login')->withErrors($validator)->withInput($request->only('email'));
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('application.pages.auth.login')->with('success','អ្នកបានចេញដោយជោគជ័យ');
    }
}
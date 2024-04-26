<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'receive_email_notification' => 'required|boolean',
            'receive_sms_notification' => 'required|boolean',
            'registration_number' => 'required|string',
            'phone' => 'required|string',
            'gender' => 'required|in:Male,Female,Other',
            'birthday' => 'required|date',
            'year_of_passed_out' => 'required|integer',
            'address' => 'required|string',
            'pincode' => 'required|string',
            'school' => 'required|string',
            'city_id' => 'required|integer',
            'qualification_id' => 'required|integer',
            'state_id' => 'required|integer',
            'aadhaar_number' => 'required|string',
            'linkedin_profile' => 'nullable|url',
            'upload_resume' => 'nullable|file|mimes:pdf,doc,docx',
            'upload_aadhar' => 'nullable|file|mimes:pdf,doc,docx',
            'avatar_url' => 'nullable|file|mimes:jpeg,jpg,png,gif',
        ]);

        $upload_aadhar = $upload_resume = $upload_avatar_url = "";
        // Handle the file upload logic
        $file = $request->file('upload_aadhar');
        if ($file)
            $upload_aadhar = $file->store('uploads'); // Store the file in the 'uploads' directory

        $file = $request->file('upload_resume');
        if ($file)
            $upload_resume = $file->store('uploads'); // Store the file in the 'uploads' directory

        $file = $request->file('avatar_url');
        if ($file)
            $upload_avatar_url = $file->store('uploads'); // Store the file in the 'uploads' directory


        // Update user
        $user = $request->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->receive_email_notification = $request->receive_email_notification;
        $user->receive_sms_notification = $request->receive_sms_notification;
        $user->registration_number = $request->registration_number;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->birthday = $request->birthday;
        $user->year_of_passed_out = $request->year_of_passed_out;
        $user->address = $request->address;
        $user->pincode = $request->pincode;
        $user->school = $request->school;
        $user->city_id = $request->city_id;
        $user->qualification_id = $request->qualification_id;
        $user->state_id = $request->state_id;
        $user->aadhaar_number = $request->aadhaar_number;
        $user->linkedin_profile = $request->linkedin_profile;

        if ($upload_resume)
            $user->upload_resume = $upload_resume;
        if ($upload_aadhar)
            $user->upload_aadhar = $upload_aadhar;

        if ($upload_avatar_url)
            $user->avatar_url = $upload_avatar_url;

        $user->save();

        return response()->json(['message' => 'User updated successfully', 'user' => new UserResource($user)]);
    }
}

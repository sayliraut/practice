<?php

namespace App\Http\Controllers;

use App\Models\IamPrincipal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class ManageProfileController extends Controller
{
    public function index()
    {
        $get_user = Auth::guard('admin')->user();
        $user = IamPrincipal::find($get_user->id);
        return view('Admin.manage_profile', compact('user'));
    }


    public function update_profile(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'phone_number' => 'required|string',
            'email_address' => 'required|email',
        ]);

        try {
            DB::beginTransaction();

            $user_detail = Auth::guard('admin')->user();
            $user = IamPrincipal::find($user_detail->id);

            $existingUser = IamPrincipal::where('email_address', $request->input('email_address'))
                ->where('id', '!=', $user->id)
                ->first();

            if ($existingUser) {
                return response()->json(['error' => 'Email address already exists.'], 400);
            }

            $user->name = $request->input('first_name');
            $user->phone_number = $request->input('phone_number');
            $user->email_address = $request->input('email_address');

            // Check if a new profile photo is provided
            if ($request->hasFile('profile_photo')) {
                $image = $request->file('profile_photo');
                $imageFilename = saveSingleImageWithoutCrop($image, 'admin_images', $user->profile_photo);
                $user->profile_photo = $imageFilename;
            }

            $user->save();

            DB::commit();

            return response()->json(['success' => true, 'status' => 200]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Profile update failed: " . $e->getMessage());
            return response()->json(['message' => 'Failed to update profile'], 500);
        }
    }
}

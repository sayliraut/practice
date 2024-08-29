<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\EducationDetail;
use App\Models\IamPrincipal;
use App\Models\ProfessionDetail;
use App\Models\Skill;
use App\Models\State;
use App\Models\UploadCerticates;
use App\Models\UserSkills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $users = IamPrincipal::with(['state', 'city'])->latest()->get();
            return view('welcome', compact('users'));
        } catch (Exception $e) {
            Log::error("Dashboard Page Load Failed: " . $e->getMessage());
            return jsonResponseWithErrorMessage(__('auth.something_went_wrong'));
        }
    }

    public function add()
    {
        try {
            $state = State::all();
            $skill = Skill::all();
            return view('add_user', compact('state', 'skill'));
        } catch (Exception $e) {
            Log::error("Add user Page Load Failed: " . $e->getMessage());
            return jsonResponseWithErrorMessage(__('auth.something_went_wrong'));
        }
    }

    public function getCities($stateId)
    {
        try {
            $cities = City::where('state_xid', $stateId)->get();
            return response()->json($cities);
        } catch (Exception $e) {
            Log::error("Fetching cities failed: " . $e->getMessage());
            return jsonResponseWithErrorMessage(__('auth.something_went_wrong'));
        }
    }

    public function store_user(Request $request)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'image' => 'required|image',
                'certificates.*' => 'required|file|mimes:pdf,jpg,jpeg,png',
            ]);
            DB::beginTransaction();
            // Save the user details
            $user = new IamPrincipal();
            $user->name = $request['name'];
            $user->date_of_birth = $request['dob'];
            $user->gender = $request['gender'];
            $user->state_xid = $request['state_xid'];
            $user->city_xid = $request['city_xid'];
            $user->email_address = $request['email'];
            $user->phone_number = $request['mobile'];

            // Save the profile image
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('profile_images', 'public');
                $user->profile_photo = $imagePath;
            }



            $user->save();

            // Save education details
            foreach ($request['education_title'] as $index => $title) {
                $education = new EducationDetail();
                $education->principal_xid = $user->id;
                $education->education = $title;
                $education->year_of_completion = $request['year_of_completion'][$index];
                $education->save();
            }

            //professional detail
            if ($request['profession'] === 'salaried') {
                $profession = new ProfessionDetail();
                $profession->principal_xid = $user->id;
                $profession->profession = $request['profession'];
                $profession->company_name = $request['company_name'];
                $profession->job_started_from = $request['job_started_from'];
                $profession->save();
            } elseif ($request['profession'] === 'self-employed') {
                $profession = new ProfessionDetail();
                $profession->principal_xid = $user->id;
                $profession->profession = $request['profession'];
                $profession->business_name = $request['business_name'];
                $profession->business_location = $request['location'];
                $profession->save();
            }


            // Save skills
            foreach ($request['skills'] as $skill) {
                $skillModel = new UserSkills();
                $skillModel->principal_xid = $user->id;
                $skillModel->skill_id = $skill;
                $skillModel->save();
            }

            // Save certificates
            if ($request->hasFile('certificates')) {
                foreach ($request->file('certificates') as $certificate) {
                    $certificatePath = $certificate->store('certificates', 'public');
                    $certificateModel = new UploadCerticates();
                    $certificateModel->principal_xid = $user->id;
                    $certificateModel->certificate_path = $certificatePath;
                    $certificateModel->save();
                }
            }

            DB::commit();

            return jsonResponseWithSuccessMessage(__('Data saved successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Store user failed: " . $e->getMessage());
            return jsonResponseWithErrorMessage(__('auth.something_went_wrong'));
        }
    }

    public function viewUser($id)
    {
        try {
            $user = IamPrincipal::with(['state', 'city'])->find($id);
            $professionDetail = ProfessionDetail::where('principal_xid', $id)->first();
            $skills = UserSkills::with('skill')->where('principal_xid', $id)->get();
            $educations = EducationDetail::where('principal_xid', $id)->get();
            $uploadCerticates = UploadCerticates::where('principal_xid', $id)->get();
            return view('view_user', compact('user', 'professionDetail', 'skills', 'educations', 'uploadCerticates'));
        } catch (Exception $e) {
            Log::error("View User Page Load Failed: " . $e->getMessage());
            return jsonResponseWithErrorMessage(__('auth.something_went_wrong'));
        }
    }



    public function edit_user($id)
    {
        try {
            $user = IamPrincipal::with(['state', 'city'])->find($id);
            $states = State::all();
            $cities = City::all();
            $professionDetail = ProfessionDetail::where('principal_xid', $id)->first();
            $allSkills = Skill::all();
            $skills = UserSkills::with('skill')->where('principal_xid', $id)->get();
            $educations = EducationDetail::where('principal_xid', $id)->get();
            $uploadCerticates = UploadCerticates::where('principal_xid', $id)->get();
            return view('edit_user', compact('user', 'professionDetail', 'skills', 'educations', 'uploadCerticates', 'allSkills', 'states', 'cities'));
        } catch (Exception $e) {
            Log::error("update Data Load Failed: " . $e->getMessage());
            return jsonResponseWithErrorMessage(__('auth.something_went_wrong'));
        }
    }



    public function update_user(Request $request)
    {
        try {

            DB::beginTransaction();

            $user =  IamPrincipal::where('id', $request->customer_id)->first();
            $user->name = $request['name'];
            $user->date_of_birth = $request['dob'];
            $user->gender = $request['gender'];
            $user->state_xid = $request['state_xid'];
            $user->city_xid = $request['city_xid'];
            $user->email_address = $request['email'];
            $user->phone_number = $request['mobile'];

            // Save the profile image
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('profile_images', 'public');
                $user->profile_photo = $imagePath;
            }

            $user->save();

            // Save education details
            $educationDetail = EducationDetail::where('principal_xid', $request->customer_id)->delete();


            foreach ($request['education_title'] as $index => $title) {
                $education = new EducationDetail();
                $education->principal_xid = $user->id;
                $education->education = $title;
                $education->year_of_completion = $request['year_of_completion'][$index];
                $education->save();
            }

            //professional detail
            if ($request['profession'] === 'salaried') {
                $profession = new ProfessionDetail();
                $profession->principal_xid = $user->id;
                $profession->profession = $request['profession'];
                $profession->company_name = $request['company_name'];
                $profession->job_started_from = $request['job_started_from'];
                $profession->save();
            } elseif ($request['profession'] === 'self-employed') {
                $profession = new ProfessionDetail();
                $profession->principal_xid = $user->id;
                $profession->profession = $request['profession'];
                $profession->business_name = $request['business_name'];
                $profession->business_location = $request['location'];
                $profession->save();
            }


            // Save skills
            $skillDetail = UserSkills::where('principal_xid', $request->customer_id)->delete();

            foreach ($request['skills'] as $skill) {
                $skillModel = new UserSkills();
                $skillModel->principal_xid = $user->id;
                $skillModel->skill_id = $skill;
                $skillModel->save();
            }

            // Save certificates
            if ($request->hasFile('certificates')) {
                foreach ($request->file('certificates') as $certificate) {
                    $certificatePath = $certificate->store('certificates', 'public');
                    $certificateModel = new UploadCerticates();
                    $certificateModel->principal_xid = $user->id;
                    $certificateModel->certificate_path = $certificatePath;
                    $certificateModel->save();
                }
            }

            DB::commit();

            return jsonResponseWithSuccessMessage(__('Data saved successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Store user failed: " . $e->getMessage());
            return jsonResponseWithErrorMessage(__('auth.something_went_wrong'));
        }
    }

    public function delete_user($id)
    {
        try {
            DB::beginTransaction();

            $user = IamPrincipal::find($id);

            $user->delete();
            DB::commit();

            return response()->json(['success' => true, 'status' => 200]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Delete user function Load Failed " . $e->getMessage());
            return response()->json(['success' => false, 'status' => 500, 'message' => __('auth.something_went_wrong')]);
        }
    }
}

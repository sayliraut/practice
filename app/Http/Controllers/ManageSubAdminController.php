<?php

namespace App\Http\Controllers;

use App\Mail\Add_Subadmin;
use App\Models\IamPrincipal;
use App\Models\ManageModule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;



use App\Models\ManageModuleLink;
use App\Models\SubadminContactAdmin;

class ManageSubAdminController extends Controller
{
    public function index()
    {
        $sub_admins_module = ManageModule::latest()->get();
        // return $sub_admins_module;
        $sub_admins_data = IamPrincipal::where('principal_type_xid', 2)->latest()->get();// 2 for subadmin

        return view('Admin.sub_admin.manage_subadmin', compact('sub_admins_data', 'sub_admins_module'));
    }

    public function create()
    {
        $sub_admins_module = ManageModule::latest()->get();
        return view('Admin.sub_admin.create', compact('sub_admins_module'));
    }

    public function store_subadmin(Request $request)
    {
        $rules = [
            'sub_admin_email' => 'required|string|email|max:100|unique:iam_principal,email_address,NULL,id,principal_type_xid,2',

        ];

        $messages = [
            'sub_admin_email.required' => 'Please enter this field',
            'sub_admin_email.email' => 'Please enter a valid email address',
            'sub_admin_email.unique' => 'This email is already registered',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            $sub_admin = new IamPrincipal();
            $sub_admin->name = $request->input('sub_admin_name');
            $sub_admin->principal_type_xid = 2;// 2 for subadmin
            $sub_admin->email_address = $request->input('sub_admin_email');
            $sub_admin->password = bcrypt($request->input('password'));
            $sub_admin->save();

            $moduleIds = $request->input('module_id');

            foreach ($moduleIds as $moduleId) {
                $sub_admin_permission = new ManageModuleLink;
                $sub_admin_permission->principal_xid = $sub_admin->id;
                $sub_admin_permission->manage_modules_xid = $moduleId;
                $sub_admin_permission->save();
            }

            $mailData = [
                'username' => $request->input('sub_admin_name'),
                'password' => $request->input('password'),
            ];

            Mail::to($sub_admin->email_address)->send(new Add_Subadmin($mailData));

            DB::commit();
            return jsonResponseWithSuccessMessage(__('success.save_data'));
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Store Subadmin Page Load Failed: " . $e->getMessage());
            return jsonResponseWithErrorMessage(__('auth.something_went_wrong'), 500);
        }
    }

    public function get_sub_admin_permission(Request $request)
    {
        $testing_admin_id = $request->id;
        $test = ManageModuleLink::where('principal_xid', $testing_admin_id)->get('manage_modules_xid')->toArray();
        return response()->json(['success' => true, 'data' => $test]);
    }

    public function AdminUsersMailView($id)
    {
        $iamprinciapl = IamPrincipal::find($id);
        $loginAdmin = auth()->guard('admin')->user();
        $dataAdmin = SubadminContactAdmin::where('sender_id', $loginAdmin->id)->where('receiver_id', $iamprinciapl->id)->get();
        $messages = $dataAdmin->sortBy('created_at');
        $affiliate_user = IamPrincipal::where('principal_type_xid', 2)->find($id); // 2 for subadmin
        return view('Admin.sub_admin.subadmin_users_mail', compact('messages', 'affiliate_user'));
    }

    public function submitSubadminResponse(Request $request)
    {

        try {

            DB::beginTransaction();
            $loginAdmin = auth()->guard('admin')->user();
            $contactAdminResponse = new SubadminContactAdmin();
            $contactAdminResponse->sender_id = $loginAdmin->id;
            $contactAdminResponse->receiver_id = $request->receiver_id;
            $contactAdminResponse->contact_admin_response = $request->contact_admin_response;
            $contactAdminResponse->is_admin_response = 1;
            $contactAdminResponse->save();
            DB::commit();
            return jsonResponseWithSuccessMessage(__('success.save_data'));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Affiliate response controller function failed " . $e->getMessage());
            return jsonResponseWithErrorMessage(__('auth.something_went_wrong'), 500);
        }
    }


    public function contactAdmin()
    {
        $loginAdmin = auth()->guard('admin')->user();

        $iamprinciapl = IamPrincipal::find($loginAdmin->id);
        $admin_user = IamPrincipal::where('principal_type_xid', 1)->first();
        $dataAdmin = SubadminContactAdmin::where('sender_id', $admin_user->id)->where('receiver_id', $iamprinciapl->id)->get();
        $messages = $dataAdmin->sortBy('created_at');

        return view("Admin.sub_admin.contact_admin", compact('messages', 'admin_user'));
    }


    public function submitSubAdminContactAdminResponse(Request $request)
    {

        // dd($request->all());

        try {
            DB::beginTransaction();
            // $loginAdminUser = auth()->guard('admin')->user();
            $loginAdmin = auth()->guard('admin')->user();
            $contactAdminResponse = new SubadminContactAdmin();
            $contactAdminResponse->sender_id = $request->sender_id;
            $contactAdminResponse->receiver_id = $loginAdmin->id;
            $contactAdminResponse->affiliate_response = $request->affiliate_response;
            $contactAdminResponse->is_affiliate_response = 0;
            $contactAdminResponse->save();
            DB::commit();
            return jsonResponseWithSuccessMessage(__('success.save_data'));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Affiliate Admin Contact Us controller Admin response function failed " . $e->getMessage());
            return jsonResponseWithErrorMessage(__('auth.something_went_wrong'), 500);
        }
    }
}

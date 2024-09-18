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

class ManageSubAdminController extends Controller
{
    public function index()
    {
        $sub_admins_module = ManageModule::latest()->get();
        // return $sub_admins_module;
        $sub_admins_data = IamPrincipal::where('principal_type_xid', 3)->latest()->get();

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
            $sub_admin->principal_type_xid = 3;
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

    public function AffliateUsersMailView($id)
    {
        $iamprinciapl = IamPrincipal::find($id);
        $loginAdmin = auth()->guard('admin')->user();
        // $dataAdmin = AffiliateContactAdmin::where('sender_id', $loginAdmin->id)->where('receiver_id', $iamprinciapl->id)->get();
        // $messages = $dataAdmin->sortBy('created_at');
        $affiliate_user = IamPrincipal::where('principal_type_xid', 3)->find($id);
        return view('admin-dashboard.pages.manage-users.affiliate_users.affiliate_users_mail', compact('messages', 'affiliate_user'));
    }
}

<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //

    public function login(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->input();
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'admin' => '1'])) {
//                Session::put('adminSession',$data['email']);
                return redirect("/admin/dashboard");
//                echo "Sukses";
//                die();


            } else {
                return redirect("/admin")->with('flash_message_error', "Invalid username and Password");
            }
        }
        return view('admin.admin_login');
    }

    public function dashboard()
    {
//        if(Session::has('adminSession')){
//
//        }
//        else{
//            return redirect("/admin")->with('flash_message_error',"Please login to access");
//        }
        return view('admin.dashboard');
    }

    /*
     * function logout
     */

    public function logout()
    {
//        echo "tst"; die;
        Session::flush();
        return redirect("/admin")->with('flash_message_success', "Logged out Successfully");
    }

    /*
     *
     */
    public function settings()
    {
        return view('admin.settings');
    }

    public function chkPassword(Request $request)
    {
//        $current_pwd =
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $check_password = User::where(['admin'=>'1']);
        if(Hash::check($current_password,$check_password->password)){
            echo "true";
            die;

        }
        else{
            echo "false";
            die;
        }
    }
}

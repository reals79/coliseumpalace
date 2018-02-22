<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ApiController extends Controller
{
    //

     public function checkIdno(Request $request)
    {
    	$results = [];

    	$idno = trim($request->idno);
    	$verify_code = strtoupper(trim($request->verify_code));

    	$user = User::where('idno', $idno)->first();
    	if ($user) {
    		$idno = substr($user->idno, -6);
    		$first_name = substr($user->first_name, 0, 1);
    		$last_name = substr($user->last_name, 0, 1);
    		$v_code = strtoupper($last_name.$first_name.$idno);

    		if ($verify_code == $v_code) {
    			$results = ['error' => false, 'success' => true, 'user_id' => $user->id];
    		} else {
    			$results = ['error' => true, 'verify_code' => trans('account.code_not_correct')];
    		}
    	} else {
    		$results = ['error' => true, 'idno' => trans('account.idno_not_found')];
    	}

    	return $results;
    }

    public function register(Request $request, User $user)
    {
    	$results = [];

    	$password = trim($request->password);
    	
    	if (!empty($password)) {
    		$user->update(['password' => bcrypt($password), 'api_token' => str_random(60), 'activated' => 1]);
    		$results = ['error' => false, 'success' => true];
    	} else {
    		$results = ['error' => true, 'password' => trans('account.password_empty')];
    	}

    	return $results;
    }

    public function userSave(Request $request)
    {
        $user = $request->user();
        $user->update($request->only('email', 'phone'));

        return;
    }

    public function settings(Request $request)
    {
        # code...
    }
    public function settingsSave(Request $request)
    {
        # code...
    }

    public function alerts(Request $request)
    {
        # code...
    }

    public function messages(Request $request)
    {
        # code...
    }

    public function leasing(Request $request)
    {
        $user = $request->user();
        return $user->load('records');
    }

    public function services(Request $request)
    {
        # code...
    }

}

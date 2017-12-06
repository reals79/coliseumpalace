<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

use App\Administrator;
use Validator;
use Auth;
use AdminTemplate;

class AdminController extends Controller
{
    protected $guard = 'admin';

    public function getLogin()
    {
        if (!Auth::guard($this->guard)->guest())
        {
            return redirect(route('admin.dashboard', '/'));
        }
        $loginPostUrl = route('admin.login.post');
        return AdminTemplate::view('pages.login', [
            'title' => config('sleeping_owl.title'),
            'loginPostUrl' => $loginPostUrl,
        ]);
    }

    public function postLogin(Request $request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];
        $data = $request->only(array_keys($rules));
        $lang = trans('sleeping_owl::validation');
        if ($lang == 'sleeping_owl::validation')
        {
            $lang = [];
        }
        $validator = Validator::make($data, $rules, $lang)->validate();

        $admin = Administrator::all();
        if ($admin->count() == 0) {
            Administrator::create(['name' => 'Administrator', 'username' => 'admin', 'password' => 'admin!']);
        }

        if (Auth::guard($this->guard)->attempt($data))
        {
            return redirect()->intended(route('admin.dashboard', '/'));
        }

        $message = new MessageBag([
            'username' => trans('sleeping_owl::lang.auth.wrong-username'),
            'password' => trans('sleeping_owl::lang.auth.wrong-password')
        ]);

        return redirect()->back()->withInput()->withErrors($message);
    }

    public function getLogout()
    {
        Auth::guard($this->guard)->logout();
        return redirect(route('admin.dashboard', '/'));
    }

}

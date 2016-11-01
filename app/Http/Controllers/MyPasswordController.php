<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Redirect;
use Session;

class MyPasswordController extends Controller
{

    protected $rules = [
      'newpassword' => 'required|min:6|confirmed',
    ];

    public function new_password(Request $request) {
      $current_user = Auth::user();

      $this->validate($request, $this->rules);

      $input = Input::all();

      if(! Auth::validate(['email' => $current_user['email'], 'password' => $input['oldpassword']])) {
        return redirect()->back()->withErrors('Incorrect old password');
      }

      $current_user['password'] = bcrypt($input['newpassword']);
      $current_user->save();

      return redirect(url('/home'))->with('message', 'Password reset');
    }
}

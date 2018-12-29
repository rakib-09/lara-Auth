<?php

namespace Rakib\LaraAuth\Http\Controllers\Authentication;

use Rakib\LaraAuth\Http\Requests\LoginRequest;
use Rakib\LaraAuth\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use Rakib\LaraAuth\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->middleware('guest')->except(['logout','getLoginList']);
        $this->middleware('auth')->only('logout');

        $this->authService = $authService;

    }

    public function getRegisterForm()
    {
        return view('laraAuth::Authentication.registerForm');
    }

    public function registration(RegisterRequest $request)
    {
        $data = $request->validated();
        if ($this->authService->register($data)) {
            return redirect('/home');
        }
    }

    public function getLoginForm()
    {
        if(request()->get('email'))
        {
            session()->flash('email',request()->get('email'));
        }

        return view('laraAuth::Authentication.loginForm');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if ($this->authService->login($data)) {
            return redirect('/home');
        } else {
            $errors = [
                'error' => 'Credentials do not match!'
            ];
            return redirect()->back()->withErrors($errors);
        }
    }

    public function getLoginList()
    {
        $userList = $this->authService->getLoginList();
        if($userList)
        {
            return view('laraAuth::Authentication.loginList', compact('userList'));
        }
        else {
            return view('laraAuth::Authentication.loginForm');
        }
    }

    public function getForgetPasswordForm()
    {
        return view('laraAuth::Authentication.forgetPassword');
    }

    public function emailForgetPassword()
    {

    }

    public function logout()
    {
        if ($this->authService->logout()) {
            return redirect('/');
        }
    }


}

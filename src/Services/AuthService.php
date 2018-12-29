<?php
/**
 * Created by PhpStorm.
 * User: jouleslabs
 * Date: 28/12/18
 * Time: 2:01 PM
 */
namespace Rakib\LaraAuth\Services;

use Rakib\LaraAuth\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Cookie;

class AuthService extends Service
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(array $data)
    {
        try{
            try {
                if (array_key_exists('avatar', $data) && $data['avatar'] != null) {
                    $data['avatar'] = $data['avatar']->store('users/images', 'public');
                }
                else {
                    $data['avatar'] = 'users/defaults/user.png';
                }
            } catch (\Exception $e) {
                $data['avatar'] = 'users/defaults/user.png';
            }
            $data['password'] = Hash::make($data['password']);

            $response = $this->authRepository->create($data);
            Auth::login($response);
            if($this->saveInfo())
            {
                return true;
            }
        }
        catch (\Exception $e){
            return $e;
        }
    }

    public function login(array $data)
    {
        $remember = false;
        if(array_key_exists('remember', $data))
        {
            $remember = $data['remember'] ? true : false;
        }
        if(Auth::attempt(['email' => $data['email'],'password' => $data['password']], $remember))
        {
            if($this->saveInfo())
            {
                return true;
            }
        }
        else
        {
            return false;
        }
    }

    public function getLoginList()
    {
        if(Cookie::get('userInfo'))
        {
            $userList = json_decode(Cookie::get('userInfo'), true);
            return $userList;
        }
        else {
            return false;
        }
    }

    public function logout()
    {
        Auth::logout();
        return true;
    }

    public function saveInfo()
    {
        $flag = 0;
        if(Cookie::get('userInfo')){
            $value = json_decode(Cookie::get('userInfo'), true);
            foreach ($value as $key => $val)
            {
                if(in_array(auth()->user()->email, $val))
                {
                    $flag = 1;
                    break;
                }
                else
                {
                    $flag = 0;
                }
            }
        }
        if($flag == 0) {
            $value[] = [
                'email' => auth()->user()->email,
                'name' => auth()->user()->name ,
                'avatar' => auth()->user()->avatar
            ];
            Cookie::queue(Cookie::make('userInfo', json_encode($value), 450000));
        }
        return true;
    }

}

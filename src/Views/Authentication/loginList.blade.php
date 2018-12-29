@extends('laraAuth::layouts.app')
@section('css')
    <style>
        .avatar {
            border-radius: 50%;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            width: 70px;
        }
        .userInfo{
            margin: 10px 0;
            padding: 10px;
            color: #555;

        }
        .userInfo:hover{
            background-color: #eee;
            border-radius: 4px;
        }
        .status{
            vertical-align: middle;
            text-align: center;
            line-height: 50px;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Choose An Account') }}</div>
                    <div class="card-body">
                        <div class="col-md-12">
                            @foreach($userList as $user)
                            <a href="{{route('user.login', ['email' => $user['email']])}}">
                                <div class="row userInfo">
                                    <div class="col-md-3 avatar">
                                        <img src="{{asset('storage/'.$user['avatar'])}}" class="avatar"/>
                                    </div>
                                    <div class="col-md-7">
                                        <h4>{{$user['email']}}</h4>
                                        <strong>{{$user['name']}}</strong>
                                    </div>
                                    <div class="col-md-2 status">
                                        <strong>Signed Out</strong>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                            <a href="{{route('user.login')}}">
                                <div class="row userInfo">
                                    <div class="col-md-3 avatar">
                                        <img src="{{asset('storage/defaults/user.png')}}" class="avatar"/>
                                    </div>
                                    <div class="col-md-9">
                                        <h4>Use Another Account</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

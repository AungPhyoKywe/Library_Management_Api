<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use Auth;

    class AuthController extends Controller
    {
        public function login()
        {
            $req_data = \request()->only('email','password');
            if(Auth::attempt($req_data)) {

                $user =  Auth::user();
                $data['access_token'] = $user->createToken('accessToken')->accessToken;
                $data['user'] = $user;
                return response()->json($data,200);
            }else {

                $data['message'] =  'user does not exists';
                return response()->json($data,401);
            }
        }
    }

    ?>

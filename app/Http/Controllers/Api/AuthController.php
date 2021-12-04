<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;
    use Auth;
    use Hash;

    class AuthController extends Controller
    {
        public function login(Request $request)
        {
            $req_data = $request->only('email','password');
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

        public function register ( Request $request) {

            $validator = Validator::make($request->all(), [
                'name' => ['required', 'min:4'],
                'email' => ['required', 'unique:users'],
                'password' => ['required', 'min:8', 'confirmed'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'err_message' => 'validation error',
                    'data' => $validator->errors(),
                ], 422);
            }else {
                $data = $request->only(['name', 'email', 'password']);
                //$data['role_serial'] = 4;
                $data['password'] = Hash::make($request->password);
                $user = User::create($data);

                Auth::login($user);
                //$user = User::where('id', Auth::user()->id)->with('user_role')->first();
                $data['access_token'] = $user->createToken('accessToken')->accessToken;
                $data['user'] = $user;
                return response()->json($data, 200);
            }
        }
    }

    ?>

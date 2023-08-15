<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Firebase\JWT\JWT;
use App\Mail\SendMail;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\PasswordChangeRequest;
use App\Http\Resources\NotificationResource;



class AuthController extends Controller
{
    use ResponseTrait;

    /**
     * @var UserRepository
     */
    protected $userRepositry;

    public function __construct()
    {
        $this->userRepositry = new UserRepository(app(User::class));
    }

    public function login(AuthRequest $request)
    {
        if (!Auth::attempt(
            $request->only([
                'phone',
                'password',
            ]))) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'msg' => __('Invalid credentials!'),
            ], 500);
        }


        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        return response(['status' => true, 'code' => 200, 'msg' => __('Log in success'), 'data' => [
            'token' => $accessToken,
            'user' => UserResource::make(Auth::user()),
        ]]);
    }



    public function store(UserRequest $request)
    {
        try {

            DB::beginTransaction();


            if (isset($request->email)) {
                $check = User::where('email', $request->email)
                    ->first();

                if ($check) {

                    return $this->returnError('The email address is already used!');
                }
            }

            if (isset($request->phone)) {
                $check = User::where('phone', $request->phone)
                    ->first();

                if ($check) {

                    return $this->returnError('The phone number is already used!');
                }
            }

            $user = $this->userRepositry->save($request);


            DB::commit();
            Auth::login($user);

            $accessToken = Auth::user()->createToken('authToken')->accessToken;

            if ($user) {
                // return $this->returnData( 'user', UserResource::make($user), '');

                return response(['status' => true, 'code' => 200, 'msg' => __('User created succesfully'), 'data' => [
                    'token' => $accessToken,
                    'user' => UserResource::make(Auth::user()),
                ]]);
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return $this->returnError('Sorry! Failed in creating user');
        }
    }

    public function check(Request $request)
    {
        if ($this->checkOTP($request->phone, $request->code)) {
            return $this->returnSuccessMessage('success');
        } else {
            return $this->returnError('Sorry! code not correct');
        }
    }

    public function profile(Request $request)
    {
        return $this->returnData('user', UserResource::make(Auth::user()), 'successful');
    }

    public function password(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();
        if ($user) {

            $otp = $this->sendOTP($request->phone);

            $user->otp = $otp;
            $user->save();

            return $this->returnSuccessMessage('Code was sent');
        }

        return $this->returnError('Code not sent User not found');
    }


    public function checkUser(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();

        if ($user) {

            return $this->returnData('user',new UserResource( $user ), 'successful');
        }

        return $this->returnError('User not found!');
    }


    public function userProfile($id)
    {
        return $this->returnData('user', UserResource::make(User::find($id)), 'successful');
    }


    public function changePassword(Request $request)
    {
        $user = User::where('phone',$request->phone)->first();

        if ($user) {


                $user->update([
                    'password' => Hash::make($request->password),
                ]);

            return $this->returnSuccessMessage('Password has been changed');
        }

        return $this->returnError('User not found!');
    }


    public function sociallogin(Request $request)
    {

        $user = User::where([
            ['email', $request->email]
        ])->first();

        if ($user) {

            $accessToken = $user->createToken('authToken')->accessToken;

            //$user->token = $request->token;
            $user->save();
            Auth::login($user);


            return response(['status' => true, 'code' => 200, 'msg' => 'success', 'data' => [
                'token' => $accessToken,
                'user' =>  UserResource::make(Auth::user($user)),
            ]]);
        }
        $phone = $request->has('phone')? $request->phone:null;

        $user = User::create([
            'name' => $request->name,
            'last_name'=>$request->last_name,
            'email' => $request->email,
            'phone'=>$phone,
            'profile_image_id'=>'1',
            'password' => Hash::make('1234'),
        ]);



        Auth::login($user);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['status' => true, 'code' => 200, 'msg' => 'success', 'data' => [
            'token' => $accessToken,
            'user' => UserResource::make(Auth::user()),
        ]]);
    }


    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $old_pw = $request->old_password;

        //   if ($user->password == $old_pw)

        if (Hash::check($old_pw, $user->password)) {


            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            return $this->returnSuccessMessage('Password has been changed');
        }

        return $this->returnError('Password not matched!');
    }

    public function updateProfile(Request $request)
    {
        try {

            $user = Auth::user();
            if ($user) {

                if (isset($request->email)) {
                    $check = User::where('email', $request->email)
                        ->first();

                    if ($check) {

                        return $this->returnError('The email address is already used!');
                    }
                }

                if (isset($request->phone)) {
                    $check = User::where('phone', $request->phone)
                        ->first();

                    if ($check) {

                        return $this->returnError('The phone number is already used!');
                    }
                }





                $this->userRepositry->edit($request, $user);

                if ($request->password) {

                    $user->update([
                            'password' => Hash::make($request->password),
                        ]);

                }








                return $this->returnData('user', new UserResource($user), 'User updated successfully');


            }




            // unset($user->image);

            return $this->returnError('Sorry! Failed to find user');
        } catch (\Exception $e) {

            // return $e;

            return $this->returnError('Sorry! Failed in updating user');
        }
    }

    public function updateById(Request $request)
    {
        try {

            $user = User::find($request->user_id);
            if ($user) {

                if (isset($request->email)) {
                    $check = User::where('email', $request->email)
                        ->first();

                    if ($check) {

                        return $this->returnError('The email address is already used!');
                    }
                }

                if (isset($request->phone)) {
                    $check = User::where('phone', $request->phone)
                        ->first();

                    if ($check) {

                        return $this->returnError('The phone number is already used!');
                    }
                }





                $this->userRepositry->edit($request, $user);

                if ($request->password) {

                    $user->update([
                            'password' => Hash::make($request->password),
                        ]);

                }








                return $this->returnData('user', new UserResource($user), 'User updated successfully');


            }




            // unset($user->image);

            return $this->returnError('Sorry! Failed to find user');
        } catch (\Exception $e) {

            // return $e;

            return $this->returnError('Sorry! Failed in updating user');
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user()->token();
        $user->revoke();

        return $this->returnSuccessMessage('Logged out succesfully!');
    }

    public function delete($id)
    {
        $user = User::find($id);

        $user->delete();



        return $this->returnSuccessMessage('Done!');
    }





    public function updatePhone(Request $request, $id)
    {
        $user = User::find($id);
        $user->phone = $request->phone;
        $user->save();

        $otp = $this->sendOTP($request->phone);

        $user->otp = $otp;
        $user->save();



        return $this->returnSuccessMessage('Code was sent!');
    }


    public function resendOTP(Request $request, $id)
    {
        $user = User::find($id);

        $otp = $this->sendOTP($user->phone);

        $user->otp = $otp;
        $user->save();



        return $this->returnSuccessMessage('Code was sent!');
    }

    public function sendOTP(Request $request)
    {
        //$otp = 5555;
        $characters = '0123456789';
        $otp = '';
        for ($i = 0; $i < 6; $i++) {
          $otp .= $characters[rand(0, strlen($characters) - 1)];
        }
        $user = User::where('email',$request->email)->first();
        $user->update([
            'otp'=>$otp
        ]);

        // Mail::to($user->email)->send(new SendMail($otp));
        // return 'Email sent successfully!';

        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://api.mailersend.com/v1//jordanstartshere.com/messages', [
        'auth' => ['api', env('MAILGUN_SECRET')],
            'form_params' => [
                'from' => 'Golden Card <goldencard@goldencard.com.jo>',
                'to' => $request->email,
                'subject' => 'OTP Verification',
                'text' => $otp+" is your verification code for " + '<a href="https://jordanstartshere.com">jordanstartshere.com</a>',
            ],
        ]);


        return $response->getBody();

        // dd( $response );

        // return $otp;
    }



    public function checkOTP(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ((string)$user->otp == (string)$request->otp) {
            $user->active = 1;
            $user->save();
            return true;

        }

        return false;
    }


    public function updateDeviceToken(Request $request)
    {
        // $user = Auth::user();
        $user = User::find($request->user_id);
        $user->device_token = $request->device_token;
        $user->save();

        return $this->returnData('user', UserResource::make($user), 'successful');
    }

        public function myNotifications()
    {


        // $notifications = Notification::where('user_id',Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        $notifications = Notification::orderBy('created_at', 'DESC')->get();
        return $this->returnData('data',  NotificationResource::collection( $notifications ), __('Get  succesfully'));

    }

    public function deactivate(Request $request)
    {
        $user = User::find($request->user_id);

        //normal user
        if($request->is_social == 0)
        {

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $randomCode = Str::random(8, $characters);

        $user->phone = 0;
        $user->email = $randomCode . 0;
        $user->active = 0;
        $user->save();

        return $this->returnSuccessMessage('Done!');
        }

        //sosial user
         if($request->is_social == 1)
        {


        $user->phone = 0;
        $user->active = 0;
        $user->save();

        return $this->returnSuccessMessage('Done!');
        }


    }

    public function sendFirebaseOtp()
    {
        $otp = rand(1000, 9999);
        $user = User::first();
        $message = new JWT();
        $message->setPayload($otp);
        $message->setExpiration(time() + 60);
        $message->setSecret(env('FIREBASE_API_KEY'));
        $response = Http::post('https://fcm.googleapis.com/v1/projects/'.env('FIREBASE_PROJECT_ID').'/messages:send', [
            'content' => $message,
            ' formatted' => true,
        ]);
        return response()->json(['status' => 'success', 'otp' => $otp]);
    }
}

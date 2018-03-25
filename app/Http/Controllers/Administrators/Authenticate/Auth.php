<?php namespace App\Http\Controllers\Administrators\Authenticate;
use App\Http\Requests;
use App\Models\Systems\Company;
use App\Models\Users\User;
use App\Models\Users\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;

trait Auth {

    // public function login() {
    //     $validator = $this->validator($this->request->all());
    //     if ($validator->fails()) {
    //         return $this->response->json(false, $validator->errors(), 'MESSAGE.VALIDATOR_FAILS');
    //     } else {
    //         $user = $this->user->where('email', $this->request->input('email'))->first();
    //         if (!$user) {
    //             return $this->response->json(false, '', 'MESSAGE.ACCOUNT_NOT_FOUND');
    //         }
    //         if ($user->active == 0) {
    //             return $this->response->json(false, '', 'MESSAGE.ACCOUNT_NON_ACTIVE');
    //         } else {
    //             if (Hash::check($this->request->input('password'), $user->password)) {
    //                 $currentTime = time();
    //                 $expire      = $currentTime + 86400;
    //                 $data        = [
    //                     'token'      => md5(uniqid($user->email, true)) . $currentTime,
    //                     'expire'     => $expire,
    //                     'user_id'    => $user->id,
    //                     'company_id' => $user->company_id,
    //                 ];
    //                 $userToken = UserToken::on();
    //                 $userToken->where('user_id', $user->id)->delete();
    //                 $userToken->insert($data);
    //                 $user->token = $data['token'];
    //                 return redirect()->action('Administrators\Systems\DashboardController@index');
    //             }
    //         }
    //     }
    //     return redirect()->action('Administrators\Authenticate\AuthController@postLogin');
    // }

    // public function logout($token) {
    //     UserToken::where('token', $token)->delete();
    //     return redirect()->action('Administrators\Authenticate\AuthController@postLogin');
    //     // JWTAuth::invalidate(JWTAuth::getToken());
    //     // return $this->response->json(true, '', 'MESSAGE.LOGOUT_SUCCESS');
    // }

    // /**
    //  * [validator validator]
    //  * @param  array  $array [all input need validate]
    //  * @return
    //  */
    // private function validator(array $array) {
    //     $messages = [
    //         'required' => ':attribute không được để trống.',
    //         'max'      => ':attribute không quá 6 ký tự.',
    //     ];
    //     return Validator::make($array, [
    //         'email'    => 'required',
    //         'password' => 'required|min:6',
    //     ], $messages);
    // }

}

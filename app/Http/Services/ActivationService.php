<?php
namespace App\Http\Services;

use App\Mail\UserActivationEmail;
use App\Models\Users\User;
use App\Models\Users\UserActivation;
use Mail;

class ActivationService {
    protected $resendAfter = 24; // Sẽ gửi lại mã xác thực sau 24h nếu thực hiện sendActivationMail()
    protected $userActivation;

    public function __construct(UserActivation $userActivation) {
        $this->userActivation = $userActivation;
    }

    public function sendActivationMail($user) {
        if ($user->active || !$this->shouldSend($user)) {
            return;
        }

        $token                 = $this->userActivation->createActivation($user);
        $user->activation_link = route('user.activate', $token);
        $mailable              = new UserActivationEmail($user);
        // //sdssttkxaqjokgjc
        config([
            'mail' => [
                'driver'     => 'smtp',
                'port'       => '587',
                'host'       => 'smtp.gmail.com',
                'username'   => 'speedandsound7890@gmail.com',
                'password'   => 'rweivdnkyrdfojuz',
                'encryption' => 'tls',
                'from'       => array(
                    'address' => 'speedandsound7890@gmail.com',
                    'name'    => 'HaiPhat-Tech',
                ),
                'stream'     => [
                    'ssl' => [
                        'allow_self_signed' => true,
                        'verify_peer'       => false,
                        'verify_peer_name'  => false,
                    ],
                ],
            ],
        ]);
        // $value = config('mail');
        Mail::to($user->email)->send($mailable);
    }

    public function activateUser($token) {
        $activation = $this->userActivation->getActivationByToken($token);
        if ($activation === null) {
            return null;
        }

        $user         = User::find($activation->user_id);
        $user->active = true;
        $user->save();
        $this->userActivation->deleteActivation($token);

        return $user;
    }

    private function shouldSend($user) {
        $activation = $this->userActivation->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }

}
<?php

namespace App\Jobs;

use App\Http\Services\MailHelper;
use App\Mail\SendEmailContact;
use App\Models\EmailSetup\EmailConfig;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendEmail implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;
    /**
     * Số lần job sẽ thử thực hiện lại
     *
     * @var int
     */
    public $tries = 3;

    /**
     * Số giây job có thể chạy trước khi timeout
     *
     * @var int
     */
    public $timeout = 60;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data) {

        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        sleep(5);
        $email       = new SendEmailContact($this->data);
        $emailConfig = EmailConfig::firstOrFail();
        if ($emailConfig) {
            config([
                'mail' => [
                    'driver'     => $emailConfig->driver,
                    'port'       => $emailConfig->port,
                    'host'       => $emailConfig->host,
                    'username'   => $emailConfig->email_sender,
                    'password'   => $emailConfig->password,
                    'from'       => array('address' => $emailConfig->email_sender, 'name' => $emailConfig->fullname),
                    'encryption' => $emailConfig->smtpsecure,
                    'stream'     => [
                        'ssl' => [
                            'allow_self_signed' => true,
                            'verify_peer'       => false,
                            'verify_peer_name'  => false,
                        ],
                    ],
                ],
            ]);

            Mail::to($this->data['email'])->send($email);
        }
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class MailController extends Controller
{
    public function showEmailForm(){
        return view('fontend.send-email');
    }

    public function sendEmail(Request $request){
		
	    $messages = [
	        'required' => 'Trường :attribute bắt buộc nhập.',
	        'email'    => 'Trường :attribute phải có định dạng email'
	    ];
	    // $validator = \Validator::make($request->all(), [
	    //     'to_email' => 'required|emails',
	    //     'subject'  => 'required',
	    //     'body'     => 'required'
	    // ], $messages);

	    // if ($validator->fails()) {
	    //     return redirect('admin/email')
	    //             ->withErrors($validator)
	    //             ->withInput();
	    // } else {

	        $email_service = $request->input('email_service');

	        switch ($email_service) {
	            case 1:
	                // Gmail
	                config(['mail.driver' => 'smtp', 'mail.host' => 'smtp.gmail.com', 'mail.port' => 587, 'mail.username' => 'allaravel.com@gmail.com', 'mail.password' => 'extpoeeoicypxqoie', 'mail.encryption' => 'tls']);
	                break;

	            case 2:
	                // MailGun
	                config(['mail.driver' => 'mailgun']);
	                break;

	            case 3:
	                // MailTrap
	                config(['mail.driver' => 'smtp', 'mail.host' => 'smtp.mailtrap.io', 'mail.port' => 2525, 'mail.username' => 'v19f3911c306955', 'mail.password' => '3e356fbba1bbb1', 'mail.encryption' => 'tls']);

	                break;

	            case 4:
	                // Sparkpost
	                config(['mail.driver' => 'sparkpost', 'mail.host' => 'smtp.sparkpostmail.com', 'mail.port' => 587, 'mail.username' => 'SMTP_Injection', 'mail.password' => 'f57d09lc09a02650d816df6f501409odpkvjcjc6', 'mail.encryption' => 'STARTTLS']);

	                break;
			// }
			$mailable = new SendEmail();
			// echo '<pre>', print_r($mailable) , '</pre>';
			// return;
	        $email_arr = explode(',', $request->input('to_email'));
	        for ($i=0; $i < count($email_arr); $i++) {
	        	$mailable = new SendEmail();
	        	Mail::to($email_arr[$i])->send($mailable);
	        }

			
	        return redirect('admin/email')
	                ->with('message', 'Send email success!');
	    }
	}
}

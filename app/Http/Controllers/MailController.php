<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use App\CustomUser;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
   // public function basic_email() {
   //    $data = array('name'=>"Hatim");
   
   //    Mail::send(['text'=>'mail'], $data, function($message) {
   //       $message->to('earnmoneyonline5253@gmail.com', 'Hatim N')->subject
   //          ('Laravel Basic Testing Mail');
   //       $message->from('webportalforlawyers@gmail.com','Hatim');
   //    });
   //    echo "Basic Email Sent. Check your inbox.";
   // }
   public function lawyerWelcome($id) {
      $user = CustomUser::find($id);
      $name = $user->name;
      $email = $user->email;
      $data = array('name'=>$name, 'email'=>$email);
      Mail::send('email.lawyerWelcome', $data, function($message) use ($data) {
         $message->to($data['email'], $data['name'])->subject
            ('Welcome to the Web Portal');
         $message->from('webportalforlawyers@gmail.com','Hatim');
      });
      return redirect('/dashboard');
   }
//    public function attachment_email() {
//       $data = array('name'=>"Virat Gandhi");
//       Mail::send('mail', $data, function($message) {
//          $message->to('abc@gmail.com', 'Tutorials Point')->subject
//             ('Laravel Testing Mail with Attachment');
//          $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
//          $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
//          $message->from('xyz@gmail.com','Virat Gandhi');
//       });
//       echo "Email Sent with attachment. Check your inbox.";
//    }
}
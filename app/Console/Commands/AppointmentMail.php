<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Appointment;
use App\CustomUser;
use App\Client;
use Mail;

class AppointmentMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:appointment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $appointments = Appointment::where('date','<=',date('Y-m-d'))->get();
        foreach($appointments->all() as $appointment){
            
                if( $appointment->mailed == 0){
                    $date = $appointment->date;
                    $clientTable = Client::select('lawyer_id')->where('client_id',$appointment->user_id)->get();
                    foreach($clientTable->all() as $c){
                        $lawyer = CustomUser::find($c['lawyer_id']);
                    }
                    $client = CustomUser::find($appointment->user_id);
                    $lawyerName = $lawyer->name;
                    $clientName = $client->name;
                    $lawyerEmail = $lawyer->email;
                    $clientEmail = $client->email;
                    $data = array('name'=>[$lawyerName,$clientName], 'email'=>[$lawyerEmail,$clientEmail],'date'=>$date);
                    Mail::send('email.appointment', $data, function($message) use ($data) {
                        $message->to($data['email'], $data['name'])->subject
                            ('Appointment Due!');
                        $message->from('webportalforlawyers@gmail.com','Hatim');
                    });
                    $re = Appointment::find($appointment->id);
                    $re->mailed = 1;
                    $re->save();
                }
            }
        
    }
    
}

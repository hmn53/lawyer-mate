<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Reminder;
use App\CaseTable;
use App\CustomUser;
use Mail;

class ReminderMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:reminder';

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
        $reminders = Reminder::where('remind_date','<=',date('Y-m-d'))->get();
        foreach($reminders->all() as $reminder){
            if(strcmp('Appointment',$reminder->type)==0){
                if($reminder->case_no != NULL && $reminder->reminded == 0){
                    $case = CaseTable::where('case_no',$reminder->case_no)->get();
                    $date = $reminder->remind_date;
                    foreach($case->all() as $c){
                        $lawyerID = $c['lawyer_id'];
                        $clientID = $c['client_id'];
                    }
                    $lawyer = CustomUser::find($lawyerID);
                    $client = CustomUser::finD($clientID);
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
                    $re = Reminder::find($reminder->id);
                    $re->reminded = 1;
                    $re->save();
                }
            }
        }
    }


}

@extends('layouts/app')

@section('content')

      <?php
        use App\Notifications\ReminderNotifications;
        use App\Reminder;
        use App\Appointment;
        use Carbon\Carbon;
        $user = auth()->user();
        // $user->notify(new Reminder("Welcome to the Web Portal for Lawyers."));
        $welcomeEmail=$user->welcome_email;
        Artisan::call('mail:reminder');
        Artisan::call('mail:appointment');
        //$reminders = Reminder::where('remind_date','<=',Carbon::now('Y-m-d'))->get();
        if($welcomeEmail == 0){
            $name = $user->name;
            $email = $user->email;
            $data = array('name'=>$name, 'email'=>$email);
            Mail::send('email.lawyerWelcome', $data, function($message) use ($data) {
                $message->to($data['email'], $data['name'])->subject
                    ('Welcome to the Web Portal');
                $message->from('webportalforlawyers@gmail.com','Admin');
            });
            $user->welcome_email=1;
            $user->save();
        }
      ?>
		    @if (strcmp($user->type,"lawyer")==0)
			    @include('includes.lawyer')
			@else
			    @include('includes.client')

			@endif

@endsection










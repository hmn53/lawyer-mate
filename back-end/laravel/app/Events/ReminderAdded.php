<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\DB;
use App\Client;

class ReminderAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username;
    public $type;
    public $user_id;
    public $send_id;
    public $message;
    public $user_type;
    public $description;
    public $date;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_id,$username,$type,$user_type,$description,$date)
    {
        $this->username = $username;
        $this->type = $type;
        $this->user_id = $user_id;
        $this->user_type = $user_type;
        $this->description = $description;
        $this->date = $date;
        if(strcmp($user_type,"client")==0){
            $this->send_id = Client::select('lawyer_id')->where('client_id',$user_id)->get();
            }
        else{
            $this->send_id = Client::select('client_id')->where('lawyer_id',$user_id)->get();
            }
        
        //$result = json_decode($send_id,true);
        $this->message  = "{$username} added a {$type} reminder";
        $channel=0;
        foreach($this->send_id as $send){
            if(strcmp($this->user_type,"client")==0){
                $channel=$send['lawyer_id'];
                }
            else{
                $channel=$send['client_id'];
                }
        }
        //echo 'reminder-added-{$channel}';
    }
    // /**
    //  * Determine if this event should broadcast.
    //  *
    //  * @return bool
    //  */
    // public function broadcastWhen()
    // {
    //     foreach($this->send_id as $send){
    //         if(strcmp($this->user_type,"client")==0){
    //             return $send['lawyer_id'] == auth()->user()->id;
    //             }
    //         else{
    //             $canSend;
    //             $canSend =  ($send['client_id'] == auth()->user()->id);
    //             echo $canSend;
    //             return $send['client_id'] == auth()->user()->id;
    //             }
    //     }
    // }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        $channel=0;
        if(strcmp($this->user_type,"client")==0){
            $this->send_id = Client::select('lawyer_id')->where('client_id',$this->user_id)->get();
            }
        else{
            $this->send_id = Client::select('client_id')->where('lawyer_id',$this->user_id)->get();
            }
        foreach($this->send_id as $send){
            if(strcmp($this->user_type,"client")==0){
                $channel=$send['lawyer_id'];
                }
            else{
                $channel=$send['client_id'];
                }
        }
        return ['reminder-added-'.$channel];
    }
}
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Libraries\MessageBroker;
use Illuminate\Support\Facades\Mail;

class MessageReader extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:read';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Baca pesan dari message broker';

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
        $msg = new MessageBroker();
        $channel = $msg->getChannel();
        $topic = 'regisma_event';
        $channel->queue_declare($topic, false, false, false, false);
        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $callback = function ($pesan) {
            $data = json_decode($pesan->body);
            switch($data->type){
                case 'sendEmailSuksesDaftar':
                    $this->sendEmailSuksesDaftar((array)$data->data);
                    break;
                case 'sendEmailSuksesUkt':
                    $this->sendEmailSuksesUkt($data->data);
                    break;
                case 'sendEmailGagalUkt':
                    $this->sendEmailGagalUkt($data->data);
                    break;
            }
        };
        
        $channel->basic_consume($topic, '', false, true, false, false, $callback);
        
        while ($channel->is_open()) {
            $channel->wait();
        }
    }

    private function sendEmailSuksesDaftar($email){
        foreach($email as $row){
            $row = (array)$row;
            Mail::send('mail/sukses_daftar', $row, function($message) use ($row) {
                $message->to($row['email'], $row['nama'])->subject($row['subject']);
                $message->from(env('MAIL_USERNAME'), $row['from']);
                $this->info("Sukses mengirim email ke : ".$row['email']);
            });
        }
    }

    private function sendEmailSuksesUkt($data){
        $data = (array)$data;
        Mail::send('mail/ukt/sukses', $data, function($message) use ($data){
            $message->to($data['email'], $data['nama'])->subject($data['subject']);
            $message->from(env('MAIL_USERNAME'), $data['from']);
            $message->priority(1);
            $this->info("Sukses mengirim email sukses ukt ke : ".$data['email']);
        });
    }

    private function sendEmailGagalUkt($data){
        $data = (array)$data;
        Mail::send('mail/ukt/gagal', $data, function($message) use ($data){
            $message->to($data['email'], $data['nama'])->subject($data['subject']);
            $message->from(env('MAIL_USERNAME'), $data['from']);
            $message->priority(1);
            $this->info("Sukses mengirim email ke : ".$data['email']);
        });
    }
}
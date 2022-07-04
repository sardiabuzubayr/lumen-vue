<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Libraries\MessageBroker;

class MessageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menjalankan Message Broker';

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
        $msg->sendMessage(json_encode([
            'type'=>'sendEmailSuksesUkt',
            'data'=>[
                ['no_pendaftaran'=>'1',
                'email'=>'sardi@umrah.ac.id'],
                ['no_pendaftaran'=>'2',
                'email'=>'private.sardi@gmail.com']
            ]
        ]), 'regisma_event');
        $this->info('Sukses mengirim pesan');
    }
}

<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEMail;
use Illuminate\Support\Facades\Log;

class EmailSendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test';

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
     * @return void
     */
    public function handle()
    {
        $this->info(sprintf(
            '[%s] email:test command start.',
            Carbon::now()->format('Y-m-d H:i:s')
        ));

        $message = 'バッチ実行だよ。';
        Mail::to('hoge@example.com')
            ->send(new TestEmail($message));

        $this->info(sprintf(
            '[%s] email:test command complete.',
            Carbon::now()->format('Y-m-d H:i:s')
        ));
    }
}

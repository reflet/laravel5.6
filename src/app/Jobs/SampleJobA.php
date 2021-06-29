<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class SampleJobA implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        $Log = Log::channel('job');
        $Log->info(self::class . ' start.');
        for ($i = 1; $i <= 5; $i++) {
            $Log->info(self::class . '::' . $i);
            sleep(1);
        }
        $Log->info(self::class . ' complete.');
    }
}

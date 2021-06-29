<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Jobs\SampleJobA;
use App\Jobs\SampleJobB;
use App\Jobs\SampleJobC;
use App\Jobs\SampleJobD;
use App\Jobs\SampleJobE;
use App\Jobs\SampleJobF;
use App\Jobs\SampleJobG;

class StartJobsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:start';

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
        $this->info(sprintf('[%s] job:start command start.', Carbon::now()->format('Y-m-d H:i:s')));

        // SampleJobAを同期(laravel-sync)で実行する
        SampleJobA::dispatch()->onQueue('laravel-sync')->delay(Carbon::now());
        $this->info(sprintf('[%s] job:start command - sample job A.', Carbon::now()->format('Y-m-d H:i:s')));

        // SampleJobBを同期(laravel-sync)で実行する
        SampleJobB::dispatch()->onQueue('laravel-sync')->delay(Carbon::now());
        $this->info(sprintf('[%s] job:start command - sample job B.', Carbon::now()->format('Y-m-d H:i:s')));

        // SampleJobCを非同期(laravel-async)で実行する
        SampleJobC::dispatch()->onQueue('laravel-async')->delay(Carbon::now());
        $this->info(sprintf('[%s] job:start command - sample job C.', Carbon::now()->format('Y-m-d H:i:s')));

        // SampleJobCを非同期(laravel-async)で実行する
        SampleJobD::dispatch()->onQueue('laravel-async')->delay(Carbon::now());
        $this->info(sprintf('[%s] job:start command - sample job D.', Carbon::now()->format('Y-m-d H:i:s')));

        // SampleJobEを非同期(laravel-async)で実行する
        SampleJobE::dispatch()->onQueue('laravel-async')->delay(Carbon::now());
        $this->info(sprintf('[%s] job:start command - sample job E.', Carbon::now()->format('Y-m-d H:i:s')));

        // SampleJobFを非同期(laravel-async)で実行する
        SampleJobF::dispatch()->onQueue('laravel-async')->delay(Carbon::now());
        $this->info(sprintf('[%s] job:start command - sample job F.', Carbon::now()->format('Y-m-d H:i:s')));

        // SampleJobGを非同期(laravel-async)に向けて発行
        SampleJobG::dispatch()->onQueue('laravel-async')->delay(Carbon::now());
        $this->info(sprintf('[%s] job:start command - sample job G.', Carbon::now()->format('Y-m-d H:i:s')));
    }
}

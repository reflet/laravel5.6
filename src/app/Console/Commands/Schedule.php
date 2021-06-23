<?php

namespace App\Console\Commands;

// use Carbon\Carbon;
use Illuminate\Console\Scheduling\ScheduleRunCommand;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Support\Facades\Log;

class Schedule extends ScheduleRunCommand
{
    /**
     * Create a new command instance.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function __construct(\Illuminate\Console\Scheduling\Schedule $schedule)
    {
        parent::__construct($schedule);
    }

    /**
     * Run the given event.
     *
     * @param Event $event
     * @return void
     */
    protected function runEvent($event)
    {
        // ↓ スケジュールの実行ログを出力する
        Log::channel('schedule')
            ->info(sprintf('Running scheduled command: %s',
                $event->getSummaryForDisplay()
            ));

        // スケジュール実行結果を出力するログを用意する ( scheduleチャンネル )
        $handlers = Log::channel('schedule')->getLogger()->getHandlers();
        foreach ($handlers as $handler) {
            if ($handler instanceof \Monolog\Handler\RotatingFileHandler) {
                $path = $handler->getUrl();
                $event->appendOutputTo($path);    // 実行結果をログ出力する
            }
        }

        parent::runEvent($event);
    }
}

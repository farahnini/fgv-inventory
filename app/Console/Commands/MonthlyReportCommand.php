<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class MonthlyReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fgv:monthly-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Monthly report has been prepared');

        // send email to realtarmizisanusi@gmail.com
        Mail::raw('Hello World', function ($message) {
            $message->to('realtarmizisanusi@gmail.com')
                ->subject('Monthly Report');
        });

        $this->info('Monthly report has been sent');
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View; // Correct namespace for View

class MonthlyReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fgv:monthly-report'; // The name of the command to be executed

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description'; // For our reference

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $this->info('Starting');
        // $this->info('Processing....');
        // sleep(2);
        // $this->error('Error. Please contact Farah');
        // $this->info('Completed');

        $this->info('Monthly report has been prepared');

        $emailContent = View::make('emails.monthly_report')->render();

        Mail::send([], [], function($message) use ($emailContent) {
            $message->to('farah.o@fgvholdings.com')
                    ->subject('Monthly Report '.now())
                    ->html($emailContent); // Use the html method to set the email content
        });

        // Send email to farah.o@fgvholdings.com
        $this->info('Sending monthly report to Farah');
    }
}
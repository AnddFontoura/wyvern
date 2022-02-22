<?php

namespace App\Console\Commands;

use App\Category;
use Illuminate\Console\Command;

class CreateFakeCategoryForTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:run-category-factory {amount}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run category factory for test';

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
        $amount = $this->argument('amount');
        $progressBar = $this->output->createProgressBar($amount);
        $progressBar->start();

        for ($i = 0; $i < $amount; $i++) {
            $progressBar->advance();
            Factory(Category::class)->create();
        }
        
        $progressBar->finish();
    }
}

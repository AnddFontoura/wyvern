<?php

namespace App\Console\Commands;

use App\Product;
use App\SubCategory;
use Illuminate\Console\Command;

class CreateFakeProductForTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-fake-product-for-test {amount}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run product for test';

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
        $category = SubCategory::count('id');

        if ($category == 0) {
            $this->info('Nenhuma sub categoria encontrada, vamos criar para evitar BUGS');
            $this->call('command:create-fake-sub-category-for-test 5');
            $this->info('Agora criar produtos');
        }

        $amount = $this->argument('amount');

        $progressBar = $this->output->createProgressBar($amount);
        $progressBar->start();

        for ($i = 0; $i < $amount; $i++) {
            $progressBar->advance();
            Factory(Product::class)->create([
                'sub_category_id' => SubCategory::inRandomOrder()->first()->id,
            ]);
        }
        
        $progressBar->finish();
    }
}

<?php

namespace App\Console\Commands;

use App\Category;
use App\SubCategory;
use Illuminate\Console\Command;

class CreateFakeSubCategoryForTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-fake-sub-category-for-test {amount}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run sub category for test';

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
        $category = Category::count('id');

        if ($category == 0) {
            $this->info('Nenhuma categoria encontrada, vamos criar para evitar BUGS');
            $this->call('command:create-fake-category-for-test 5');
            $this->info('Agora criar subcategorias');
        }

        $amount = $this->argument('amount');

        $progressBar = $this->output->createProgressBar($amount);
        $progressBar->start();

        for ($i = 0; $i < $amount; $i++) {
            $progressBar->advance();
            Factory(SubCategory::class)->create([
                'category_id' => Category::inRandomOrder()->first()->id,
            ]);
        }
        
        $progressBar->finish();
    }
}

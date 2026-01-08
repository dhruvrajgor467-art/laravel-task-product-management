<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateProductsCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:generate-csv {count=100000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate products CSV file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = (int) $this->argument('count');

        $path = 'products_sample_import.csv';
        $handle = fopen(storage_path("app/{$path}"), 'w');

        // CSV File Header
        fputcsv($handle, [
            'name',
            'description',
            'price',
            'category',
            'stock',
            'image'
        ]);

        for ($i = 1; $i <= $count; $i++) {
            fputcsv($handle, [
                "Product {$i}",
                "Description for product {$i}",
                rand(100, 5000),
                'Electronics',
                rand(1, 100),
                ''
            ]);
        }

        fclose($handle);

        $this->info("CSV generated: storage/app/{$path}");
    }
}

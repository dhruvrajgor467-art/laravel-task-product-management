<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
   public function model(array $row)
    {
        return new Product([
            'name'        => $row['name'],
            'description' => $row['description'] ?? null,
            'price'       => $row['price'],
            'category'    => $row['category'],
            'stock'       => $row['stock'],
            'image'       => $row['image'] ?? 'products/default.png',
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}

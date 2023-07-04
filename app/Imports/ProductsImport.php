<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\SubCategory;
use App\Notifications\ImportHasFailedNotification;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue, WithValidation
{
  use Importable;

  /**
  * @param Illuminate\Support\Collection $row
  *
  * @return null
  */
  public function collection(Collection $rows)
  {
    foreach ($rows as $row) {
      $cats = explode(',', $row['cat_id']);
      $subcats = explode(',', $row['subcat_id']);
      $brands = explode(',', $row['brand_id']);
      $images = explode(',', $row['image']);
      $product = Product::create([
        'plu' => $row['plu'],
        'name' => $row['name'],
        'slug'=>$row['name'],
        'description' => $row['description'],
        'photo' => $row['photo'],
        'promotion' => $row['promotion'],    
        'price' => $row['minprice'],                           
        'status' => $row['status']
        
      ]);

      if($cats[0] !== "")
        foreach ($cats as $cat)
          $product->categories()->sync($cat, false);

      if($subcats[0] !== "")
        foreach ($subcats as $subcat) {
          $cat = SubCategory::find($subcat)->category()->pluck('id');
          $product->categories()->sync($cat, false);
          $product->subcat()->sync($subcat, false);
        }

      if($brands[0] !== "")
        foreach ($brands as $brand)
          $product->brands()->sync($brand, false);

      if($images[0] !== "")
        foreach ($images as $img) {
          $product->images()->create([
            'name' => $img,
            'status' => 'active'
          ]);
      }
    }
  }

  public function rules(): array
  {
    return [
      '*.id' => ['id', 'unique:product,id']
    ];
  }

  /**
  * Import data in small chunks
  *
  * @return int
  */
  public function chunkSize(): int
  {
    return 500;
  }
}

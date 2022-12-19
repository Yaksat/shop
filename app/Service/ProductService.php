<?php

namespace App\Service;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function store($data)
    {
        try {
            Db::beginTransaction();

            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);

            if (isset($data['tags'])) {
                $tagsIds = $data['tags'];
                unset($data['tags']);
            }
            if (isset($data['colors'])) {
                $colorsIds = $data['colors'];
                unset($data['colors']);
            }
            if (isset($data['product_images'])) {
                $productImages = $data['product_images'];
                unset($data['product_images']);
            }

            $product = Product::firstOrCreate([
                'title' => $data['title']
            ], $data);

            if (isset($tagsIds)) {
                $product->tags()->attach($tagsIds);
            }
            if (isset($colorsIds)) {
                $product->colors()->attach($colorsIds);
            }
            if (isset($productImages)) {
                foreach ($productImages as $productImage) {
                    $filePath = Storage::disk('public')->put('/images', $productImage);
                    ProductImage::create([
                        'file_path' => $filePath,
                        'product_id' => $product->id,
                    ]);
                }
            }

            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            abort(500);
        }
    }

    public function update($data, $product)
    {
        try {
            Db::beginTransaction();

            if (isset($data['tags'])) {
                $tagsIds = $data['tags'];
                unset($data['tags']);
            }
            if (isset($data['colors'])) {
                $colorsIds = $data['colors'];
                unset($data['colors']);
            }

            if (isset($data['preview_image'])) {
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            }

            if (isset($data['product_images'])) {
                $productImages = $data['product_images'];
                unset($data['product_images']);
            }

            $product->update($data);

            if (isset($tagsIds)) {
                $product->tags()->sync($tagsIds);
            }

            if (isset($colorsIds)) {
                $product->colors()->sync($colorsIds);
            }

            if (isset($productImages)) {
                foreach ($productImages as $productImage) {
                    $filePath = Storage::disk('public')->put('/images', $productImage);
                    ProductImage::create([
                        'file_path' => $filePath,
                        'product_id' => $product->id,
                    ]);
                }
            }

            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            abort(500);
        }

        return $product;
    }
}

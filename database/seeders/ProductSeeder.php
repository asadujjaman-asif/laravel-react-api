<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Tag;
use App\Models\ProductImage;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::get('https://dummyjson.com/products');

        if ($response->successful()) {
            $products = $response->json('products');

            foreach ($products as $productData) {

                // Insert Category
                $category = Category::firstOrCreate(
                    ['name' => $productData['category']],
                    ['slug' => Str::slug($productData['category'])]
                );

                // Insert Brand
                $brandTitle = $productData['brand'] ?? 'Unknown Brand';
                $brand = Brand::firstOrCreate(
                    ['name' => $brandTitle],
                    ['slug' => Str::slug($brandTitle)]
                );

                // Insert Product
                $product = Product::create([
                    'title' => $productData['title'],
                    'slug' => Str::slug($productData['title']),
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'discount_percentage' => $productData['discountPercentage'] ?? 0,
                    'rating' => $productData['rating'],
                    'stock' => $productData['stock'],
                    'category_id' => $category->id,
                    'brand_id' => $brand->id,
                    'sku' => $productData['sku'] ?? Str::upper(Str::random(10)),
                    'weight' => $productData['weight'] ?? null,
                    'width' => $productData['dimensions']['width'] ?? null,
                    'height' => $productData['dimensions']['height'] ?? null,
                    'depth' => $productData['dimensions']['depth'] ?? null,
                    'warranty_information' => $productData['warrantyInformation'] ?? null,
                    'shipping_information' => $productData['shippingInformation'] ?? null,
                    'availability_status' => $productData['availabilityStatus'] ?? 'In Stock',
                    'return_policy' => $productData['returnPolicy'] ?? null,
                    'minimum_order_quantity' => $productData['minimumOrderQuantity'] ?? 1,
                    'barcode' => $productData['meta']['barcode'] ?? null,
                    'qr_code' => $productData['meta']['qrCode'] ?? null,
                    'thumbnail' => $productData['thumbnail'] ?? null,
                ]);

                // Insert Tags
                foreach ($productData['tags'] ?? [] as $tagTitle) {
                    $tag = Tag::firstOrCreate(
                        ['name' => $tagTitle],
                        //['slug' => Str::slug($tagTitle)]
                    );
                    $product->tags()->attach($tag);
                }

                // Insert Images
                foreach ($productData['images'] ?? [] as $imageUrl) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_url' => $imageUrl,
                    ]);
                }

                // Insert Reviews
                foreach ($productData['reviews'] ?? [] as $review) {
                    Review::create([
                        'product_id' => $product->id,
                        'rating' => $review['rating'],
                        'comment' => $review['comment'],
                        'reviewer_name' => $review['reviewerName'],
                        'reviewer_email' => $review['reviewerEmail'],
                        'reviewed_at' => $review['date'],
                    ]);
                }
            }

            $this->command->info('✅ Products seeded successfully from API.');
        } else {
            $this->command->error('❌ Failed to fetch data from dummyjson.com.');
        }
    }
}

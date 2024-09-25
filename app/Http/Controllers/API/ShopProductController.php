<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use App\Models\ShopProduct;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;

class ShopProductController extends Controller
{
    use ApiResponseTrait;

    public function latestShopProducts(Request $request)
    {
        $categories = Category::with('shopProducts')->get();

        $latestShopProducts = [];

        foreach ($categories as $category) {
            $latestShopProduct = $category->shopProducts()->latest()->first();
            if ($latestShopProduct) {
                $latestShopProducts[] = $latestShopProduct;
            }
        }

        $perPage = 2; // adjust the pagination limit as needed
        $paginator = new Paginator($latestShopProducts, $perPage);

        $paginator->withPath(url()->current()); // set the pagination URL

        return response()->json([
            'message' => 'Data fetched successfully.',
            'data' => $paginator->items($paginator->currentPage()),
            'meta' => [
                'total' => count($latestShopProducts), // use count instead of total
                'per_page' => $paginator->perPage(),
                'current_page' => $paginator->currentPage(),
                'last_page' => ceil(count($latestShopProducts) / $perPage), // calculate last page
                'next_page_url' => $paginator->url($paginator->currentPage() + 1),
                'prev_page_url' => $paginator->url($paginator->currentPage() - 1),
            ],
        ]);
    }

    public function categoryShopProducts(Request $request)
    {
        $categoryId = $request->input('category_id');
        $category = Category::find($categoryId);
        $childCategories = $category->subCategory()->get();

        $categoryResponse = [
            'id' => $category->id,
            'name' => $category->name,
            'subcategories' => []
        ];

        if ($childCategories->count() > 0) {
            foreach ($childCategories as $childCategory) {
                $subcategoryResponse = [
                    'id' => $childCategory->id,
                    'name' => $childCategory->name,
                    'shop_products' => []
                ];

                foreach ($childCategory->shopProducts as $product) {
                    $subcategoryResponse['shop_products'][] = [
                        'id' => $product->id,
                        'user_id' => $product->user_id,
                        'product_id' => $product->product_id,
                        'category_id' => $product->category_id,
                        'quantity' => $product->quantity,
                        'unit_price' => $product->unit_price,
                        'total_price' => $product->total_price
                    ];
                }

                $categoryResponse['subcategories'][] = $subcategoryResponse;
            }
        } else {
            $categoryResponse['shop_products'] = [];
            foreach ($category->shopProducts as $product) {
                $categoryResponse['shop_products'][] = [
                    'id' => $product->id,
                    'user_id' => $product->user_id,
                    'product_id' => $product->product_id,
                    'category_id' => $product->category_id,
                    'quantity' => $product->quantity,
                    'unit_price' => $product->unit_price,
                    'total_price' => $product->total_price
                ];
            }
        }

        return $this->successResponse('Data fetched successfully.', $categoryResponse);
    }


}

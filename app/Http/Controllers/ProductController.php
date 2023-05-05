<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\RequestCreate;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $products = Product::all();
            return response()->json([
                'success' => true,
                'message' => 'Başarılı, ürünler getirildi.',
                'count' => $products->count(),
                'data' => $products
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hata, ürünler getirilemedi.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        try {

            $product = Product::with(['images','categories','attributes'])->findOrFail($request->id);

            if($product->attributes->count() > 0){
                foreach($product->attributes as $attribute){
                    $attribute->values = ProductAttribute::find($attribute->id)->attributeValues;
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Başarılı, ürün getirildi.',
                'data' => $product
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hata, ürün getirilemedi.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}

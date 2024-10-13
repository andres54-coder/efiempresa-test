<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        $query =  Product::query();


        if ($request->has('price')) {
            $query->where('price', $request->input('price'));
        }

        if ($request->has('stock')) {
            $query->where('stock', $request->input('stock'));
        }

        if ($request->has('ean_13')) {
            $query->where('ean_13', $request->input('ean_13'));
        }

        $products = $query->get();

        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'active' => 'required|boolean',
            'price' => 'required|decimal',
            'stock' => 'required|integer',
            'ean_13' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            throw new HttpResponseException(response()->json(['errors' => $errors], 422));
        }
        $data = $validator->validated();
        $product = Product::create(
            $data
        );

        return response()->json($product, 201); // Use 201 for created resources

    }

    public function show($id)
    {
        $task = Product::findOrFail($id);

        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'active' => 'required|boolean',
            'price' => 'required|decimal',
            'stock' => 'required|integer',
            'ean_13' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            throw new HttpResponseException(response()->json(['errors' => $errors], 422));
        }

        $task = Product::findOrFail($id);
        $task->update($validator->validated());

        return response()->json($task);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return response()->noContent();
    }
}

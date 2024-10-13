<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\tax;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaxController extends Controller
{

    public function index()
    {
        return response()->json(Tax::all(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'percentage' => 'required',
            'description' => 'required'
        ]);
        $tax = Tax::create($request->all());
        return response()->json($tax, Response::HTTP_CREATED);
    }

    public function show(Tax $tax)
    {
        return response()->json($tax, Response::HTTP_OK);
    }

    public function update(Request $request, Tax $tax)
    {
        $request->validate([
            'name' => 'required',
            'percentage' => 'required',
            'description' => 'required'
        ]);
        $tax->update($request->all());
        return response()->json($tax, Response::HTTP_OK);
    }

    public function destroy(Tax $tax)
    {
        $tax->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}

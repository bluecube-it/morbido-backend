<?php

namespace App\Http\Controllers;

use App\Dataset;
use Illuminate\Http\Request;

class DatasetController extends Controller
{
    public function index()
    {
        return Dataset::all();
    }

    public function uploadDataset(Request $request)
    {
        $path = $request->file('dataset')->store('datasets');

        $dataset = Dataset::create([
            'original_name' => $request->dataset->getClientOriginalName(),
            'unique_name' => $path,
            'size' => $request->dataset->getSize(),
        ]);

        return $dataset;
    }
}

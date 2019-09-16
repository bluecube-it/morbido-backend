<?php

namespace App\Http\Controllers;

use App\Dataset;
use Illuminate\Http\Request;
use App\Helpers\MorbidoClient;

class DatasetController extends Controller
{
    public function index()
    {
        return Dataset::all();
    }

    public function uploadDataset(Request $request)
    {
        $path = $request->file('dataset')->store('datasets');

        // Call Python REST ML.
        $morbidoClient = new MorbidoClient();
        $morbidoResponse = $morbidoClient->doRequest('POST', '/dataset/shape', [
            'multipart' => [
                [
                    'name' => 'dataset',
                    'contents' => $request->file('dataset'),
                ],
            ]
        ]);   

        $dataset = Dataset::create([
            'original_name' => $request->dataset->getClientOriginalName(),
            'unique_name' => $path,
            'size' => $request->dataset->getSize(),
            'columns' => $morbidoResponse->columns,
            'rows' => $morbidoResponse->rows,
        ]);

        return $dataset;
    }
}

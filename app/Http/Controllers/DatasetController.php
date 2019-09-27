<?php

namespace App\Http\Controllers;

use Storage;
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
                    'contents' => Storage::get($path),
                ],
            ]
        ]);   

        if ($morbidoResponse instanceof \GuzzleHttp\Exception\RequestException) {
            throw new \Exception($morbidoResponse->getMessage());
        }

        $dataset = Dataset::create([
            'original_name' => $request->dataset->getClientOriginalName(),
            'unique_name' => $path,
            'size' => $request->dataset->getSize(),
            'columns' => $morbidoResponse['columns'],
            'rows' => $morbidoResponse['rows'],
        ]);

        return $dataset;
    }

    public function columns(Request $request)
    {
        $dataset = Storage::get($request->dataset);

        // Call Python REST ML.
        $morbidoClient = new MorbidoClient();

        $morbidoResponse = $morbidoClient->doRequest('POST', '/dataset/columns', [
            'multipart' => [
                [
                    'name' => 'dataset',
                    'contents' => $dataset,
                ],
            ]
        ]); 

        if ($morbidoResponse instanceof \GuzzleHttp\Exception\RequestException) {
            throw new \Exception($morbidoResponse->getMessage());
        }

        return $morbidoResponse;
    }
}

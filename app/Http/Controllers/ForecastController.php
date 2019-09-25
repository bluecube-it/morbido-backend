<?php

namespace App\Http\Controllers;

use Storage;
use App\Dataset;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helpers\MorbidoClient;

class ForecastController extends Controller
{
    public function sarima(Request $request)
    {
        // Call Python REST ML.
        $morbidoClient = new MorbidoClient();
        $morbidoResponse = $morbidoClient->doRequest('POST', '/forecasts/sarima', [
            'multipart' => [
                [
                    'name' => 'filename',
                    'contents' => Storage::get($request->filename),
                ],
                [
                    'name' => 'index',
                    'contents' => $request->index,
                ],
                [
                    'name' => 'input',
                    'contents' => $request->input,
                ],
                [
                    'name' => 'precision',
                    'contents' => $request->precision,
                ],
                [
                    'name' => 'prediction',
                    'contents' => $request->prediction,
                ],
                [
                    'name' => 'seasonality',
                    'contents' => $request->seasonality,
                ],
            ]
        ]);  

        if ($morbidoResponse instanceof \GuzzleHttp\Exception\RequestException) {
            throw new \Exception($morbidoResponse->getMessage());
        }

        foreach ($morbidoResponse['data'] as &$item) {
            $item['date'] = Carbon::parse($item['date'])->toDateString();
            $item = array_values($item);
        }

        $morbidoResponse['name'] = 'Prediction';

        return $morbidoResponse;
    }
}

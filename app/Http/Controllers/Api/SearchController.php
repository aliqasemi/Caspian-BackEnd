<?php

namespace App\Http\Controllers\Api;

use App\Helpers\SearchInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Search\SearchModelRequest;
use Illuminate\Support\Arr;

class SearchController extends Controller implements SearchInterface
{
    //full text search
    public function search(SearchModelRequest $request)
    {
        $searchResult = [];
        foreach (config('models') as $models) {
            foreach ($models as $model) {
                Arr::set($searchResult, class_basename($model), $model::search($request->keyword)->get());
            }
        }
        return $searchResult;
    }
}

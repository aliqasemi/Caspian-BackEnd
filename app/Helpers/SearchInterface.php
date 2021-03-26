<?php

namespace App\Helpers;

use App\Http\Requests\Search\SearchModelRequest;

interface SearchInterface
{
    public function search(SearchModelRequest $request);
}

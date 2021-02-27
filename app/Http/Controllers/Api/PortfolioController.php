<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\PortfolioStoreRequest;
use App\Http\Requests\Portfolio\PortfolioUpdateRequest;
use App\Http\Resources\PortfolioResource;
use App\Models\Portfolio;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Portfolio::class);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return PortfolioResource
     */
    public function store(PortfolioStoreRequest $request)
    {
        $this->authorize('create', Portfolio::class);

        $data = $request->all();

        $portfolio = Portfolio::create([
            'title' => Arr::get($data, 'title'),
            'description' => Arr::get($data, 'description'),
            'transplantation_id' => Arr::get($data, 'transplantation_id')
        ]);

        $portfolio->save();

        $portfolio->load(['transplantation', 'transplantation.user']);

        return new PortfolioResource(
            $portfolio
        );
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Portfolio $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        $this->authorize('view', Portfolio::class);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Portfolio $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(PortfolioUpdateRequest $request, Portfolio $portfolio)
    {
        $this->authorize('update', Portfolio::class);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Portfolio $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        $this->authorize('delete', Portfolio::class);

    }
}

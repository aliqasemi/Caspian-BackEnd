<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transplantation\TransplantationStoreRequest;
use App\Http\Requests\Transplantation\TransplantationUpdateRequest;
use App\Models\Transplantation;

class TransplantationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Transplantation::class);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransplantationStoreRequest $request)
    {
        $this->authorize('create', Transplantation::class);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transplantation  $transplantation
     * @return \Illuminate\Http\Response
     */
    public function show(Transplantation $transplantation)
    {
        $this->authorize('view', Transplantation::class);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transplantation  $transplantation
     * @return \Illuminate\Http\Response
     */
    public function update(TransplantationUpdateRequest $request, Transplantation $transplantation)
    {
        $this->authorize('update', Transplantation::class);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transplantation  $transplantation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transplantation $transplantation)
    {
        $this->authorize('delete', Transplantation::class);

    }
}

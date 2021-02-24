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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransplantationStoreRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transplantation  $transplantation
     * @return \Illuminate\Http\Response
     */
    public function show(Transplantation $transplantation)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transplantation  $transplantation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transplantation $transplantation)
    {
        //
    }
}

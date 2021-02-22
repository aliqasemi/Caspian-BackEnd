<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transplantation;
use Illuminate\Http\Request;

class TransplantationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd("aaa");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, Transplantation $transplantation)
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

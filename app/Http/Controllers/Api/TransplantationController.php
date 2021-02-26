<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transplantation\TransplantationStoreRequest;
use App\Http\Requests\Transplantation\TransplantationUpdateRequest;
use App\Http\Resources\TransplantationResource;
use App\Models\Transplantation;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

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
     * @return TransplantationResource
     */
    public function store(TransplantationStoreRequest $request)
    {
        $this->authorize('create', Transplantation::class);

        $data = $request->all();

        $transplantation = Transplantation::create([
            'name' => Arr::get($data, 'name'),
            'category' => Arr::get($data, 'category'),
            'user_id' => Auth::id()
        ]);

        $transplantation->save();

        $transplantation->load('user');

        return new TransplantationResource(
            $transplantation
        );
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

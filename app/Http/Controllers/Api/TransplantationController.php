<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorException;
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
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $this->authorize('view', Transplantation::class);

        return TransplantationResource::collection(
            Transplantation::with('user')
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
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
     * @param \App\Models\Transplantation $transplantation
     * @return TransplantationResource
     */
    public function show(Transplantation $transplantation)
    {
        $this->authorize('view', Transplantation::class);

        $transplantation = Transplantation::findOrFail($transplantation->id);

        $transplantation->load('user');

        return new TransplantationResource(
            $transplantation
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Transplantation $transplantation
     * @return TransplantationResource
     */
    public function update(TransplantationUpdateRequest $request, Transplantation $transplantation)
    {
        $this->authorize('update', Transplantation::class);

        $data = $request->all();

        $transplantation = Transplantation::findOrFail($transplantation->id);

        $transplantation->fill($data);
        $transplantation->save();

        $transplantation->load('user');

        return new TransplantationResource(
            $transplantation
        );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Transplantation $transplantation
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Transplantation $transplantation)
    {
        $this->authorize('delete', Transplantation::class);

        $response = Transplantation::destroy([$transplantation->id]);

        if ($response == true)
            return response()->json('عملیات با موفقیت انجام شد');

    }
}

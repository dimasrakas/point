<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\PricingGroup\StorePricingGroupRequest;
use App\Http\Requests\Master\PricingGroup\UpdatePricingGroupRequest;
use App\Http\Resources\ApiCollection;
use App\Http\Resources\ApiResource;
use App\Model\Master\PricingGroup;
use Illuminate\Http\Request;

class PricingGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return ApiCollection
     */
    public function index(Request $request)
    {
        $pricingGroup = PricingGroup::from(PricingGroup::getTableName().' as '.PricingGroup::$alias)->eloquentFilter($request);

        $pricingGroup = PricingGroup::joins($pricingGroup, $request->get('join'));

        $pricingGroup = pagination($pricingGroup, $request->get('limit'));

        return new ApiCollection($pricingGroup);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return ApiResource
     */
    public function store(StorePricingGroupRequest $request)
    {
        $pricingGroup = new PricingGroup;
        $pricingGroup->fill($request->all());
        $pricingGroup->save();

        return new ApiResource($pricingGroup);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  int $id
     * @return ApiResource
     */
    public function show(Request $request, $id)
    {
        $pricingGroup = PricingGroup::from(PricingGroup::getTableName().' as '.PricingGroup::$alias)->eloquentFilter($request);

        $pricingGroup = PricingGroup::joins($pricingGroup, $request->get('join'));

        $pricingGroup = $pricingGroup->where(PricingGroup::$alias.'.id', $id)->first();

        return new ApiResource($pricingGroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return ApiResource
     * @throws \Throwable
     */
    public function update(UpdatePricingGroupRequest $request, $id)
    {
        $pricingGroup = PricingGroup::findOrFail($id);
        $pricingGroup->fill($request->all());
        $pricingGroup->save();

        return new ApiResource($pricingGroup);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pricingGroup = PricingGroup::findOrFail($id);
        $pricingGroup->delete();

        return response()->json([], 204);
    }
}

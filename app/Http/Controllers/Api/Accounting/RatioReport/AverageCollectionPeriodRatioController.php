<?php

namespace App\Http\Controllers\Api\Accounting\RatioReport;

use App\Helpers\Ratio\AverageCollectionPeriodRatio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AverageCollectionPeriodRatioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ratio = new AverageCollectionPeriodRatio();

        return $ratio->get($request->get('date_from'), $request->get('date_to'));
    }
}

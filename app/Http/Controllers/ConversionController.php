<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConversionRequest;
use App\Http\Resources\ConversionCollection;
use App\Http\Resources\ConversionResource;
use App\Models\Conversion;
use App\Services\IntegerConverterInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ConversionController extends Controller {
    public function convert(StoreConversionRequest $request, IntegerConverterInterface $converter ) {

        $validated = $request->validated();
        $romanValue = $converter->convertInteger( $validated['integer'] );
        $conversion = Conversion::create(['integer_value' => $validated['integer'], 'roman_value' => $romanValue]);

        return new ConversionResource($conversion);
    }

    public function recentConversions() {
        #'recent' so just get the ones from today

        $conversions = Conversion::whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->get();

        return new ConversionCollection($conversions);

    }

    public function topConversions() {
        $conversions =  Conversion::select('integer_value', DB::raw('count(*) as count'))
            ->groupBy('integer_value')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();

        return new ConversionCollection($conversions);

    }


}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConversionRequest;
use App\Http\Resources\ConversionResource;
use App\Models\Conversion;
use App\Services\IntegerConverterInterface;
use Illuminate\Support\Facades\DB;

class ConversionController extends Controller {
    public function convert(StoreConversionRequest $request, IntegerConverterInterface $converter ) {

        $validated = $request->validated();
        $romanValue = $converter->convertInteger( $validated['integer'] );
        $conversion = Conversion::create(['integer_value' => $validated['integer'], 'roman_value' => $romanValue]);

        return new ConversionResource($conversion);
    }

    public function recentConversions() {
        return Conversion::orderBy('created_at', 'desc')->get();
    }

    public function topConversions() {
        return Conversion::select('integer_value', DB::raw('count(*) as count'))
            ->groupBy('integer_value')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();
    }


}

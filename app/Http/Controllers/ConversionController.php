<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConversionRequest;
use App\Http\Resources\ConversionCollection;
use App\Http\Resources\ConversionResource;
use App\Models\Conversion;
use App\Services\IntegerConverterInterface;

class ConversionController extends Controller {
    public function convert(StoreConversionRequest $request, IntegerConverterInterface $converter ) {

        $validated = $request->validated();
        $romanValue = $converter->convertInteger( $validated['integer'] );
        $conversion = Conversion::create(['integer_value' => $validated['integer'], 'roman_value' => $romanValue]);

        return new ConversionResource($conversion);
    }

    public function recentConversions() {

        $conversions = Conversion::recent()->orderBy('created_at', 'desc')->get();
        return new ConversionCollection($conversions);

    }

    public function topConversions() {

        $conversions = Conversion::top()->get();
        return new ConversionCollection($conversions);

    }


}

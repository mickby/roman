<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConversionRequest;
use App\Http\Resources\ConversionCollection;
use App\Http\Resources\ConversionResource;
use App\Models\Conversion;
use App\Services\IntegerConverterInterface;

class ConversionController extends Controller
{
    /**
     * Convert an integer to its Roman numeral representation.
     *
     * @param StoreConversionRequest $request The Form Request containing the integer to convert.
     * @param IntegerConverterInterface $converter The service used to convert integers.
     * @return ConversionResource The API Resource representation of the created conversion.
     */
    public function convert(StoreConversionRequest $request, IntegerConverterInterface $converter): ConversionResource
    {
        $validated = $request->validated();
        $romanValue = $converter->convertInteger($validated['integer']);
        $conversion = Conversion::create(['integer_value' => $validated['integer'], 'roman_value' => $romanValue]);

        return new ConversionResource($conversion);
    }

    /**
     * Get the recent conversions created today.
     *
     * @return ConversionCollection A collection of recent conversions.
     */
    public function recentConversions(): ConversionCollection
    {
        $conversions = Conversion::recent()->orderBy('created_at', 'desc')->get();
        return new ConversionCollection($conversions);
    }

    /**
     * Get the top conversions based on integer value.
     *
     * @return ConversionCollection A collection of top conversions.
     */
    public function topConversions(): ConversionCollection
    {
        $conversions = Conversion::top()->get();
        return new ConversionCollection($conversions);
    }
}

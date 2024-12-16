<?php

namespace App\Http\Controllers;

use App\Models\Conversion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConversionController extends Controller {
    public function convert(Request $request) {
        // Validate input
        $validated = $request->validate(['integer' => 'required|integer|min:1|max:3999']);
        
        // Convert to Roman numeral
        $romanValue = $this->toRoman($validated['integer']);
        
        // Store conversion
        Conversion::create(['integer_value' => $validated['integer'], 'roman_value' => $romanValue]);
        
        return response()->json(['roman' => $romanValue]);
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

    private function toRoman(int $number): string {
        // ... conversion logic ...
    }
} 
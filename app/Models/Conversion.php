<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Conversion extends Model
{
    use HasFactory;
    protected $fillable = ['integer_value', 'roman_value'];

    public function scopeRecent($query) {
        return $query->whereDate('created_at', Carbon::today());
    }

    public function scopeTop($query) {
        return $query->select('integer_value', DB::raw('count(*) as count'))
            ->groupBy('integer_value')
            ->orderBy('count', 'desc')
            ->take(10);
    }
}

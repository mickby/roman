<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Conversion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['integer_value', 'roman_value'];

    /**
     * Scope to only include recent conversions created today.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeRecent($query): Builder
    {
        return $query->whereDate('created_at', Carbon::today());
    }

    /**
     * Scope to get the top conversions based on integer value.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeTop($query): Builder
    {
        return $query->select('integer_value', DB::raw('count(*) as count'))
            ->groupBy('integer_value')
            ->orderBy('count', 'desc')
            ->take(10);
    }
}

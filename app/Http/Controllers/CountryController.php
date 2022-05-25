<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CountryController extends Controller
{
    //
    public function __invoke(Request $request): Collection
    {
        return Country::query()
            ->select('id', 'name', 'country_code')
            ->orderBy('country_code')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('name', 'like', "%{$request->search}%")
                    ->orWhere('country_code', 'like', "%{$request->search}%")
            )
            ->when(
                $request->selected,
                fn (Builder $query) => $query->whereIn('id', $request->selected),
                fn (Builder $query) => $query->limit(10)
            )
            ->get();
    }

}

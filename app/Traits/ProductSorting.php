<?php

namespace App\Traits;

trait ProductSorting
{
    /**
     * Dynamically apply sorting to a product query
     */
    protected function applySorting($query)
    {
        $sort = request('sort', 'popularity');

        switch ($sort) {
            case 'popularity':
                return $query->sortByPopularity();
            case 'latest':
                return $query->sortByLatest();
            case 'price-asc':
                return $query->sortByPriceLowToHigh();
            case 'price-desc':
                return $query->sortByPriceHighToLow();
            default:
                return $query->sortByPopularity();
        }
    }
}

<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasSearch
{
    public function scopeSearch(Builder $query, array $filters): Builder
    {
        if (!empty($filters['q'])) {
            $q = $filters['q'];
            $query->where(function ($sub) use ($q) {
                foreach ($this->searchable ?? [] as $column) {
                    $sub->orWhere($column, 'LIKE', "%{$q}%");
                }
            });
        }

        foreach ($filters as $key => $value) {
            if ($key !== 'q' && in_array($key, $this->searchable ?? []) && $value !== null && $value !== '') {
                $query->where($key, 'LIKE', "%{$value}%");
            }
        }

        return $query;
    }
}

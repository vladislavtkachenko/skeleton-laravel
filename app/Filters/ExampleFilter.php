<?php

namespace App\Filters;

use App\Filters\AbstractClasses\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ExampleFilter
 *
 * @package App\Filters
 */
class ExampleFilter extends QueryFilter
{
    /**
     * Фильтр по типу объекта
     *
     * @param $value
     * @return mixed
     */
    protected function object_type($value) : Builder
    {
        return $this->builder->whereHas('objectType', function ($q) use ($value){
            /** @var $q Builder */
            return $q->whereIn('slug' ,$value);
        });
    }
}
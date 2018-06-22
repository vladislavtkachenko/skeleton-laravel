<?php

namespace App\Filters\AbstractClasses;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class QueryFilter
 *
 * @property Builder $builder
 * @property Request request
 *
 * @package App\Filters\AbstractClasses
 */
abstract class QueryFilter
{
    protected $builder;
    protected $request;

    /**
     * Конструктор фильтра
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Все фильтры переданные в класс
     *
     * @return array
     */
    private function filters() : array
    {
        return $this->request->all();
    }

    /**
     * Применяем фильтры к данным
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply($builder) : Builder
    {
        $this->builder = $builder;

        foreach ($this->filters() as $filter => $value){
            if(!$value) continue;
            if(method_exists($this, $filter)) $this->$filter($value);
        }

        return $this->builder;
    }
}
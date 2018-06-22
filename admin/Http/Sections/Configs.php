<?php

namespace Admin\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\FormElements;
use SleepingOwl\Admin\Section;

class Configs extends Section implements Initializable
{
    public function initialize()
    {
        $this->title = 'Настройки';
        $this->icon = 'fa fa-cog';

        $this->updating(function($config, \Illuminate\Database\Eloquent\Model $model) {
            cache()->forget('config');
        });
    }

    public function onDisplay()
    {
        return AdminDisplay::datatables()
            ->setApply(function ($q) { return $q->orderBy('title'); })
            ->setColumns([
                AdminColumn::text('title', 'Название'),
                \AdminColumnEditable::text('value', 'Значение'),
            ]);
    }

    public function onEdit($id)
    {
        return AdminForm::form()->addElement(
            new FormElements([
                AdminFormElement::columns()
                    ->addColumn([AdminFormElement::text('title', 'Название')->setReadonly(1)])
                    ->addColumn([AdminFormElement::text('key', 'Ключ')->setReadonly(1)]),
                AdminFormElement::columns()
                    ->addColumn([AdminFormElement::textarea('value', 'Значение')->required()])
            ])
        );
    }

    public function isCreatable()
    {
        return false;
    }

    public function isDeletable(Model $model)
    {
        return false;
    }
}
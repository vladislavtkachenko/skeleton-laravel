<?php

namespace Admin\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

class Contacts extends Section implements Initializable
{
    public function initialize()
    {
        $this->title = 'Контакты';
        $this->icon = 'fa fa-fw fa-phone';
    }

    public function onDisplay()
    {
        return AdminDisplay::datatables()
            ->setApply(function ($q) { return $q->orderBy('created_at', 'desc'); })
            ->setColumns([
                AdminColumn::text('name', 'Имя'),
                AdminColumn::text('phone', 'Телефон'),
                AdminColumn::text('email', 'Email'),
                AdminColumn::text('message', 'Сообщение'),
                AdminColumn::datetime('created_at', 'Время'),
            ])
            ->setDisplaySearch(1)
            ->paginate(20);
    }

    public function onEdit($id)
    {
        $columns = [
            AdminFormElement::text('name', 'Имя')->setReadonly(1),
            AdminFormElement::text('phone', 'Телефон')->setReadonly(1),
            AdminFormElement::text('email', 'Email')->setReadonly(1),
            AdminFormElement::textarea('message', 'Сообщение')->setReadonly(1),
            AdminFormElement::datetime('created_at', 'Время')->setReadonly(1),
        ];

        return AdminForm::panel()->addBody($columns);
    }

    public function isCreatable()
    {
        return false;
    }

    public function isDeletable(Model $model)
    {
        return true;
    }
}
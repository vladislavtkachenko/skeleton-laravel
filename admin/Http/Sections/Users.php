<?php

namespace Admin\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Models\Seo;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\FormElements;
use SleepingOwl\Admin\Section;

class Users extends Section implements Initializable
{
    public function initialize()
    {
        $this->title = 'Пользователи';
        $this->icon = 'fa fa-users-o';
    }

    public function isCreatable()
    {
        return false;
    }

    public function isDeletable(Model $model)
    {
        return true;
    }

    public function onDisplay()
    {
        return AdminDisplay::datatables()
            ->setColumns([
                AdminColumn::text('email', 'Email'),
                AdminColumn::text('name', 'Имя'),
                AdminColumn::datetime('created_at', 'Зарегистрирован'),
                AdminColumn::datetime('updated_at', 'Изменен'),
            ])
            ->setDisplaySearch(1)
            ->paginate(20);
    }

    public function onEdit($id)
    {
        $form_main = new FormElements([
            AdminFormElement::text('email', 'Email'),
            AdminFormElement::text('name', 'Имя'),
        ]);

        $tabs = AdminDisplay::tabbed([
            'Общая информация' => $form_main,
        ]);

        return AdminForm::panel()->addBody($tabs);
    }
}
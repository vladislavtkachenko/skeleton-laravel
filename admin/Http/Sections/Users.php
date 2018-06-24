<?php

namespace Admin\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\FormElements;
use SleepingOwl\Admin\Section;

class Users extends Section implements Initializable
{
    protected $checkAccess = true;

    public function initialize()
    {
        $this->title = 'Пользователи';
        $this->icon = 'fa fa-users-o';
    }

    public function onDisplay()
    {
        return AdminDisplay::datatables()
            ->setColumns([
                AdminColumn::text('id', 'Id'),
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

    /**
     * @return void
     */
    public function onDelete($id)  {}
}
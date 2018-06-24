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

class Pages extends Section implements Initializable
{
    public function initialize()
    {
        $this->title = 'Страницы';
        $this->icon = 'fa fa-fw fa-file-text-o';
    }

    public function isCreatable()
    {
        return false;
    }

    public function isDeletable(Model $model)
    {
        return false;
    }

    public function onDisplay()
    {
        return AdminDisplay::datatables()
            ->setColumns([
                AdminColumn::text('title', 'Название'),
                AdminColumn::datetime('updated_at', 'Последнее изменение'),
            ])
            ->setDisplaySearch(1)
            ->paginate(20);
    }

    public function onEdit($id)
    {
        $form_main = new FormElements([
            AdminFormElement::text('title', 'Название')->setReadonly(1),
            AdminFormElement::ckeditor('content', 'Контент'),
        ]);

        $tabs = AdminDisplay::tabbed([
            'Общая информация' => $form_main,
            'SEO' => new FormElements([
                AdminFormElement::columns()
                    ->addColumn([AdminFormElement::text('seo.title', 'Заголовок (title)')]),
                AdminFormElement::columns()
                    ->addColumn([AdminFormElement::text('seo.keywords', 'Ключевые слова (keywords)')]),
                AdminFormElement::columns()
                    ->addColumn([AdminFormElement::textarea('seo.description', 'Описание (description)')]),
                AdminFormElement::columns()
                    ->addColumn([AdminFormElement::text('seo.seo_title', 'Заголовок seo текста на странице')]),
                AdminFormElement::columns()
                    ->addColumn([AdminFormElement::textarea('seo.seo_text', 'seo текст на странице')]),
            ])
        ]);

        return AdminForm::panel()->addBody($tabs);
    }
}
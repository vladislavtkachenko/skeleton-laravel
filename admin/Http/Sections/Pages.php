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

class Pages extends Section implements Initializable
{
    public function initialize()
    {
        $this->title = 'Страницы';
        $this->icon = 'fa fa-fw fa-file-text-o';

        $this->updating(function($config, \Illuminate\Database\Eloquent\Model $model) {
            cache()->flush();
        });
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
            ])
            ->setDisplaySearch(1)
            ->paginate(20);
    }

    public function onEdit($id)
    {
        $form_main = new FormElements([
            AdminFormElement::text('title', 'Название')->setReadonly(1),
            AdminFormElement::ckeditor('content_ru', 'Контент ru'),
            AdminFormElement::ckeditor('content_en', 'Контент en'),
        ]);

        $tabs = AdminDisplay::tabbed([
            'Общая информация' => $form_main,
            'SEO' => new FormElements([
                AdminFormElement::columns()
                    ->addColumn([AdminFormElement::text('seo.title_ru', 'Заголовок (title) ru')])
                    ->addColumn([AdminFormElement::text('seo.title_en', 'Заголовок (title) en')]),
                AdminFormElement::columns()
                    ->addColumn([AdminFormElement::text('seo.keywords', 'Ключевые слова (keywords)')]),
                AdminFormElement::columns()
                    ->addColumn([AdminFormElement::textarea('seo.description_ru', 'Описание (description) ru')])
                    ->addColumn([AdminFormElement::textarea('seo.description_en', 'Описание (description) en')]),
                AdminFormElement::columns()
                    ->addColumn([AdminFormElement::text('seo.seo_title_ru', 'Заголовок seo текста на странице ru')])
                    ->addColumn([AdminFormElement::text('seo.seo_title_en', 'Заголовок seo текста на странице en')]),
                AdminFormElement::columns()
                    ->addColumn([AdminFormElement::textarea('seo.seo_text_ru', 'seo текст на странице ru')])
                    ->addColumn([AdminFormElement::textarea('seo.seo_text_en', 'seo текст на странице en')]),
            ])
        ]);

        return AdminForm::panel()->addBody($tabs);
    }
}
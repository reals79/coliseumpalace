<?php

use SleepingOwl\Admin\Model\ModelConfiguration;
use SleepingOwl\Admin\Form\FormElements;

use App\Content;

AdminSection::registerModel(Content::class, function (ModelConfiguration $model) {
    $model->setTitle('Разделы меню');

    $model->setRedirect(['create' => 'display', 'edit' => 'display']);

    // Display
    $model->onDisplay(function ($scopes = []) {
        $display = AdminDisplay::datatables()->setColumns([
            AdminColumn::order()->setLabel('Сортировка')->setHtmlAttribute('class', 'text-center')->setWidth('100px'),
            AdminColumn::link('name')->setLabel('Наименование'),
            AdminColumnEditable::checkbox('on_mainpage')->setLabel('На главной')->setWidth('80px')->setHtmlAttribute('class', 'text-center'),
            AdminColumnEditable::checkbox('footer')->setLabel('В подвал')->setWidth('80px')->setHtmlAttribute('class', 'text-center'),
            AdminColumnEditable::checkbox('activated')->setLabel('Актив.')->setWidth('80px')->setHtmlAttribute('class', 'text-center')
        ]);
        $display->paginate(25);

        if ($scopes) {
            $display->getScopes()->push($scopes);
            $display->setApply(function ($query) {
                $query->orderBy('order', 'asc');
            });
        } else {
            $display->setApply(function ($query) {
                $query->where('content_id', 0)->orderBy('order', 'asc');
            });
        }

        return $display;
    });

    // Create And Edit
   $model->onCreateAndEdit(function($id = null) {
        $display = AdminDisplay::tabbed();
        $display->setTabs(function () use ($id) {
            $tabs = [];
            $form = AdminForm::form();
            $form->setElements([
                AdminFormElement::hidden('content_id')->setDefaultValue(0),
                AdminFormElement::text('name', 'Наименование')->required(),
                AdminFormElement::wysiwyg('descr', 'Контент', 'ckeditor'),
                AdminFormElement::checkbox('on_mainpage', 'Отображать на главной странице')->setDefaultValue(0),
                AdminFormElement::checkbox('footer', 'В подвал')->setDefaultValue(0),
                AdminFormElement::checkbox('activated', 'Актив.')->setDefaultValue(1)
            ]);
            $tabs[] = AdminDisplay::tab($form)->setLabel('Ред.')
                ->setActive(true)
                ->setIcon('<i class="fa fa-pencil"></i>');

                if (!is_null($id)) {
                    /*$instance = Content::find($id);

                    if (!is_null($instance->content_id) && $instance->content_id > 0) {
                        if (!is_null($content = AdminSection::getModel(Content::class)->fireEdit($instance->content_id))) {
                            $tabs[] = AdminDisplay::tab(
                                new FormElements([$content])
                            )->setLabel('Form from Related');
                        }
                    }*/

                    $submenus = AdminSection::getModel(Content::class)->fireDisplay(['scopes' => ['withSubmenus', $id]]);
                    //$submenus->getScopes()->push(['withSubmenus', $id]);
                    $submenus->setParameter('content_id', $id);

                    $tabs[] = AdminDisplay::tab($submenus)
                        ->setLabel('Подменю')
                        ->setIcon('<i class="fa fa-bars"></i>');
                }

            return $tabs;
        });

        return $display;
    });

});

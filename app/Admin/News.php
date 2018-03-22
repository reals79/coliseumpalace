<?php

use SleepingOwl\Admin\Model\ModelConfiguration;
use SleepingOwl\Admin\Form\FormElements;

use App\News;

AdminSection::registerModel(News::class, function (ModelConfiguration $model) {
    $model->setTitle('Новости');

    $model->setRedirect(['create' => 'display', 'edit' => 'display']);

    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables()->setColumns([
            AdminColumn::link('title')->setLabel('Заголовок'),
            AdminColumn::datetime('when_at')->setLabel('Дата новости')->setWidth('140px')->setFormat('d.m.Y H:i'),
            AdminColumnEditable::checkbox('promo')->setLabel('Промо')->setWidth('80px')->setHtmlAttribute('class', 'text-center'),
            AdminColumnEditable::checkbox('activated')->setLabel('Актив.')->setWidth('80px')->setHtmlAttribute('class', 'text-center')
        ]);
        $display->setApply(function ($query) {
            $query->orderBy('when_at', 'desc');
        });
        $display->setOrder([[2, 'desc']]);

        $display->paginate(25);

        return $display;
    });

    // Create And Edit
   $model->onCreateAndEdit(function($id = null) {

        $form = AdminForm::panel();

        $form->addBody(
            AdminFormElement::columns()
                ->addColumn(function() {
                    return [
                        AdminFormElement::datetime('when_at', 'Дата новости')->setCurrentDate(),
                        AdminFormElement::text('title', 'Заголовок')->required(),
                        AdminFormElement::wysiwyg('descr', 'Контент', 'ckeditor')->required(),
                        AdminFormElement::images('images', 'Изображения'),
                        AdminFormElement::checkbox('promo', 'Промо')->setDefaultValue(1),
                        AdminFormElement::checkbox('activated', 'Актив.')->setDefaultValue(1)
                    ];
                })
        );

        return $form;
    });

});

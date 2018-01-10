<?php

use SleepingOwl\Admin\Model\ModelConfiguration;
use SleepingOwl\Admin\Form\FormElements;

use App\Video;

AdminSection::registerModel(Video::class, function (ModelConfiguration $model) {
    $model->setTitle('Видеогалерея');

    $model->setRedirect(['create' => 'display', 'edit' => 'display']);

    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables()->setColumns([
            AdminColumn::order()->setLabel('Сортировка')->setHtmlAttribute('class', 'text-center')->setWidth('100px'),
            AdminColumn::link('name')->setLabel('Наименование'),
            AdminColumnEditable::checkbox('activated')->setLabel('Актив.')->setWidth('80px')->setHtmlAttribute('class', 'text-center')
        ]);
        $display->setApply(function ($query) {
            $query->orderBy('order', 'asc');
        });

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
                        AdminFormElement::text('name', 'Наименование'),
                        AdminFormElement::checkbox('activated', 'Актив.')->setDefaultValue(1),
                        AdminFormElement::file('path', 'Видео-файл'),
                        AdminFormElement::text('path_external', 'Ссылка на внешний источник'),
                    ];
                })
        );

        return $form;
    });

});

<?php

use SleepingOwl\Admin\Model\ModelConfiguration;
use SleepingOwl\Admin\Form\FormElements;

AdminSection::registerModel(\App\Building::class, function (ModelConfiguration $model) {
    $model->setTitle('Здания');

    $model->setRedirect(['create' => 'display', 'edit' => 'display']);

    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables()->setColumns([
            AdminColumn::order()->setLabel('Сортировка')->setHtmlAttribute('class', 'text-center')->setWidth('100px'),
            AdminColumn::link('name')->setLabel('Наименование'),
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
                    ];
                })
        );

        return $form;
    });

});

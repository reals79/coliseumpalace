<?php

use SleepingOwl\Admin\Model\ModelConfiguration;
use SleepingOwl\Admin\Form\FormElements;

AdminSection::registerModel(App\Notice::class, function (ModelConfiguration $model) {
    $model->setTitle('Уведомления');

    $model->setRedirect(['create' => 'display', 'edit' => 'display']);

    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables();
        $display->with('users');
        $display->setColumns([
            AdminColumn::link('subject')->setLabel('Тема'),
            AdminColumn::lists('users.full_name')->setLabel('Кому'),
            AdminColumnEditable::checkbox('to_all')->setLabel('Всем')->setWidth('80px')->setHtmlAttribute('class', 'text-center'),
            AdminColumnEditable::checkbox('activated')->setLabel('Актив.')->setWidth('80px')->setHtmlAttribute('class', 'text-center'),
            AdminColumn::datetime('created_at')->setLabel('Дата')->setWidth('140px')->setFormat('d.m.Y H:i'),
        ]);
        $display->setApply(function ($query) {
            $query->orderBy('created_at', 'desc');
        });
        $display->setOrder([[3, 'desc']]);

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
                        AdminFormElement::multiselect('users', 'Получатели', App\User::class)->setDisplay('full_name'),
                        AdminFormElement::checkbox('to_all', 'Отправить Всем')->setDefaultValue(1),
                        AdminFormElement::text('subject', 'Тема')->required(),
                        AdminFormElement::wysiwyg('message', 'Контент', 'ckeditor')->required(),
                        AdminFormElement::checkbox('activated', 'Актив.')->setDefaultValue(1)
                    ];
                })
        );

        return $form;
    });

});

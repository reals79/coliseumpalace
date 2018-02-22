<?php

use App\User;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(User::class, function (ModelConfiguration $model) {
    $model->setTitle('Клиенты');

    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables();
        $display->setColumns([
                AdminColumn::link('last_name')->setLabel('Фамилия'),
                AdminColumn::link('first_name')->setLabel('Имя'),
                AdminColumn::email('email')->setLabel('E-mail')->setWidth('250px'),
                AdminColumn::text('phone')->setLabel('Телефон')->setWidth('250px'),
                AdminColumn::text('contract')->setLabel('Договор')->setWidth('100px'),
                AdminColumnEditable::checkbox('activated')->setLabel('Актив.')->setWidth('80px')->setHtmlAttribute('class', 'text-center'),
                AdminColumnEditable::checkbox('notify_is_email')->setLabel('Уведомление по Email')->setWidth('80px')->setHtmlAttribute('class', 'text-center'),
                AdminColumnEditable::checkbox('notify_is_sms')->setLabel('Уведомление по SMS')->setWidth('80px')->setHtmlAttribute('class', 'text-center'),
                AdminColumn::datetime('updated_at')->setLabel('Дата обновления')->setFormat('d.m.Y')->setWidth('130px'),
            ])->paginate(25);

        $display->setColumnFilters([
            AdminColumnFilter::text()->setPlaceholder('Фамилия клиента'),
            AdminColumnFilter::text()->setPlaceholder('Имя клиента'),
            AdminColumnFilter::text()->setPlaceholder('Email'),
            AdminColumnFilter::text()->setPlaceholder('Телефон'),
            AdminColumnFilter::text()->setPlaceholder('Договор'),
            null, null, null,
            AdminColumnFilter::range()->setFrom(
                AdminColumnFilter::date()->setPlaceholder('От')->setFormat('d.m.Y')
            )->setTo(
                AdminColumnFilter::date()->setPlaceholder('До')->setFormat('d.m.Y')
            )
        ]);

        return $display;
    });

    // Create And Edit
    $model->onEdit(function() {

        $form = AdminForm::panel();

        $form->addBody(
            AdminFormElement::columns()
                ->addColumn(function() {
                    return [
                        AdminFormElement::text('last_name', 'Фамилия'),
                        AdminFormElement::text('first_name', 'Имя'),
                        AdminFormElement::text('email', 'E-mail'),
                        AdminFormElement::text('phone', 'Телефон'),
                        AdminFormElement::text('contract', 'Договор'),
                    ];
                })->addColumn(function() {
                    return [
                        
                    ];
                })
        );

        return $form;

    });

});

<?php

use App\User;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(User::class, function (ModelConfiguration $model) {
    $model->setTitle('Клиенты');

    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables();
        $display->setColumns([
                AdminColumn::email('email')->setLabel('E-mail')->setWidth('250px'),
                AdminColumn::text('name')->setLabel('Имя'),
                AdminColumn::text('company_name')->setLabel('Компания'),
                AdminColumn::text('phone')->setLabel('Телефон')->setWidth('250px'),
                AdminColumn::datetime('created_at')->setLabel('Дата регистрации')->setFormat('d.m.Y')->setWidth('150px'),
            ])->paginate(25);

        $display->setColumnFilters([
            AdminColumnFilter::text()->setPlaceholder('Email'),
            AdminColumnFilter::text()->setPlaceholder('Имя клиента'),
            AdminColumnFilter::text()->setPlaceholder('Компания'),
            AdminColumnFilter::text()->setPlaceholder('Телефон'),
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
                        AdminFormElement::text('email', 'E-mail'),
                        AdminFormElement::text('name', 'Имя'),
                        AdminFormElement::text('company_name', 'Компания'),
                        AdminFormElement::text('phone', 'Телефон')->required()->unique(),
                    ];
                })->addColumn(function() {
                    return [
                        
                    ];
                })
        );

        return $form;

    });

});

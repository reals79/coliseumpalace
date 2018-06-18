<?php

use App\User;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(User::class, function (ModelConfiguration $model) {
    $model->setTitle('Клиенты');

    $model->setRedirect(['create' => 'display', 'edit' => 'display']);

    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::tabbed();
        $display->setTabs(function() {
            
            $tabs = [];

            $main = AdminDisplay::datatables()->paginate(25);
            $main->setColumns([
                AdminColumn::link('last_name')->setLabel('Фамилия')->setWidth('200px'),
                AdminColumn::link('first_name')->setLabel('Имя')->setWidth('200px'),
                AdminColumnEditable::text('email')->setLabel('E-mail')->setWidth('200px'),
                AdminColumnEditable::text('phone')->setLabel('Телефон')->setWidth('200px'),
                //AdminColumn::text('contract')->setLabel('Договор')->setWidth('80px'),
                AdminColumnEditable::checkbox('activated')->setLabel('Актив.')->setWidth('80px')->setHtmlAttribute('class', 'text-center'),
                //AdminColumnEditable::checkbox('notify_is_email')->setLabel('Уведомление по Email')->setWidth('80px')->setHtmlAttribute('class', 'text-center'),
                //AdminColumnEditable::checkbox('notify_is_sms')->setLabel('Уведомление по SMS')->setWidth('80px')->setHtmlAttribute('class', 'text-center'),
                AdminColumn::datetime('updated_at')->setLabel('Дата обновления')->setFormat('d.m.Y')->setWidth('130px'),
                AdminColumn::custom('Действие', function(User $model) {
                    return (!empty($model->api_token)) ? '<p class="text-center"><form action="' . route('login') . '" role="form" method="POST" target="_blank">' . csrf_field() . '<input type="hidden" name="api_token" value="' . $model->api_token . '"><button type="submit">Вход</button></form></p>' : '';
                })->setWidth('100px'),
            ]);
            $main->setColumnFilters([
                AdminColumnFilter::text()->setPlaceholder('Фамилия клиента'),
                AdminColumnFilter::text()->setPlaceholder('Имя клиента'),
                AdminColumnFilter::text()->setPlaceholder('Email'),
                AdminColumnFilter::text()->setPlaceholder('Телефон'),
                null, //AdminColumnFilter::text()->setPlaceholder('Договор'),
                AdminColumnFilter::range()->setFrom(
                    AdminColumnFilter::date()->setPlaceholder('От')->setFormat('d.m.Y')
                )->setTo(
                    AdminColumnFilter::date()->setPlaceholder('До')->setFormat('d.m.Y')
                ),
                null
            ]);

            $tabs[] = AdminDisplay::tab($main, 'Клиенты')->setActive();

            $noticeColumns = AdminDisplay::datatables()->setModelClass(App\Notice::class)->paginate(25);
            
            $noticeColumns->setColumns([
                
            ]);
            $tabs[] = AdminDisplay::tab($noticeColumns, 'Уведомления');

            return $tabs;
        });

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

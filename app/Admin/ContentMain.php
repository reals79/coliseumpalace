<?php

use SleepingOwl\Admin\Model\ModelConfiguration;
use SleepingOwl\Admin\Form\FormElements;

use App\ContentMain;

AdminSection::registerModel(ContentMain::class, function (ModelConfiguration $model) {
    $model->setTitle('Главная страница');

    $model->setRedirect(['create' => 'display', 'edit' => 'display']);

    // Display
    $model->onDisplay(function () {
        
        $table = AdminDisplay::datatables()->setModelClass(ContentMain::class)->setColumns([
            AdminColumn::order()->setLabel('Сортировка')->setHtmlAttribute('class', 'text-center')->setWidth('100px'),
            AdminColumn::link('name')->setLabel('Наименование'),
            AdminColumnEditable::checkbox('activated')->setLabel('Актив.')->setWidth('80px')->setHtmlAttribute('class', 'text-center')
        ]);
        $table->paginate(25);

        $table->setApply(function ($query) {
            $query->where('content_id', -2)->orderBy('order', 'asc');
        });
        
        $columns = AdminFormElement::columns()->addColumn(function() {
                    return [
                        AdminFormElement::text('name', 'Заголовок')->setDefaultValue('Coliseum Palace - Ваша территория комфорта'),
                        AdminFormElement::text('descr', 'Описание')->setDefaultValue('10 поводов выбрать Coliseum Palace')
                    ];
                });

        /*$form = AdminForm::form()->addElement(
            AdminFormElement::columns()
                ->addColumn(function() {
                    return [
                        AdminFormElement::text('name', 'Заголовок'),
                        AdminFormElement::text('descr', 'Описание')
                    ];
                })
        );*/

        $tabs = AdminDisplay::tabbed();
        $tabs->appendTab(new FormElements([$columns, $table]), '');

        return $tabs;
    });

    // Create And Edit
   $model->onCreateAndEdit(function($id = null) {

        $form = AdminForm::panel();
        $form->addBody(
            AdminFormElement::columns()
                ->addColumn(function() {
                    return [
                        AdminFormElement::hidden('content_id')->setDefaultValue(-2),
                        AdminFormElement::text('name', 'Наименование')->required(),
                        AdminFormElement::wysiwyg('descr', 'Контент', 'ckeditor'),
                        AdminFormElement::images('images', 'Images'),
                        AdminFormElement::checkbox('activated', 'Актив.')->setDefaultValue(1)
                    ];
                })
        );

        return $form;
    });

});

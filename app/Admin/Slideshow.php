<?php

use SleepingOwl\Admin\Model\ModelConfiguration;
use SleepingOwl\Admin\Form\FormElements;

use App\Slideshow;

AdminSection::registerModel(Slideshow::class, function (ModelConfiguration $model) {
    $model->setTitle('Слайдшоу');

    $model->setRedirect(['create' => 'display', 'edit' => 'display']);

    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables()->setColumns([
            AdminColumn::order()->setLabel('Сортировка')->setHtmlAttribute('class', 'text-center')->setWidth('100px'),
            AdminColumn::image('image')->setLabel('Изображение')->setHtmlAttribute('class', 'text-center')->setWidth('100px'),
            AdminColumn::link('title')->setLabel('Заголовок'),
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
                        AdminFormElement::image('image', 'Изображение')->required(),
                        AdminFormElement::textarea('title', 'Заголовок')->setRows(3),
                        AdminFormElement::wysiwyg('descr', 'Контент', 'ckeditor'),
                        AdminFormElement::checkbox('activated', 'Актив.')->setDefaultValue(1)
                    ];
                })
        );

        return $form;
    });

});

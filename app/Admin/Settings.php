<?php

use SleepingOwl\Admin\Model\ModelConfiguration;
use SleepingOwl\Admin\Form\FormElements;
use SleepingOwl\Admin\Form\Buttons\Save;

use App\Settings;

AdminSection::registerModel(Settings::class, function (ModelConfiguration $model) {
    $model->setTitle('Настройки');

    $model->disableCreating();
    $model->disableDeleting();

    // Display
    $model->onDisplay(function () use ($model) {
        $columns = AdminFormElement::columns();

        foreach (Settings::all()->pluck('id') as $id) {
            if (!is_null($id)) {
                $columns->addColumn([$model->fireEdit($id)]);
            }
        }

        $tabs = AdminDisplay::tabbed();
        $tabs->appendTab(new FormElements([$columns]), '');

        return $tabs;
    });

    // Create And Edit
   $model->onEdit(function($id = null) {
        $form = AdminForm::panel();
        $form->addBody(
            AdminFormElement::columns()
                ->addColumn(function() {
                    return [
                        AdminFormElement::text('descr', 'Описание')->setReadonly(true)->setValueSkipped(true),
                        AdminFormElement::text('name', 'Наименование')->setReadonly(true)->setValueSkipped(true),
                        AdminFormElement::text('value', 'Значение'),
                    ];
                })
        );

        $form->getButtons()->replaceButtons([
            'delete' => null,
            'save'   =>  (new Save())->setGroupElements([]),
            'cancel'  => null,
        ]);
        return $form;
    });

});

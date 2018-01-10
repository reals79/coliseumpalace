<?php

use SleepingOwl\Admin\Model\ModelConfiguration;
use SleepingOwl\Admin\Form\FormElements;
use SleepingOwl\Admin\Form\Buttons\Save;

use App\ContentSimple;

AdminSection::registerModel(ContentSimple::class, function (ModelConfiguration $model) {

    // Display
    $model->onDisplay(function () use ($model) {
        /*$columns = AdminFormElement::columns();

        $content = ContentAbout::firstOrCreate(['content_id' => -5]);
        $columns->addColumn([$model->fireEdit($content->id)]);

        $tabs = AdminDisplay::tabbed();
        $tabs->appendTab(new FormElements([$columns]), '');

        return $tabs;*/
    });

    // Create And Edit
   $model->onEdit(function($id = null) {
        $form = AdminForm::panel();
        $form->addBody(
            AdminFormElement::columns()
                ->addColumn(function() {
                    return [
                        AdminFormElement::textarea('name', 'Заголовок')->setRows(2),
                        AdminFormElement::textarea('descr', 'Описание')->setRows(2),
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

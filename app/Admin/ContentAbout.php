<?php

use SleepingOwl\Admin\Model\ModelConfiguration;
use SleepingOwl\Admin\Form\FormElements;
use SleepingOwl\Admin\Form\Buttons\Save;

use App\ContentAbout;

AdminSection::registerModel(ContentAbout::class, function (ModelConfiguration $model) {
    $model->setTitle('О нас');

    //$model->disableCreating();
    //$model->disableDeleting();

    // Display
    $model->onDisplay(function () use ($model) {
        $columns = AdminFormElement::columns();

        $content = ContentAbout::firstOrCreate(['content_id' => -4]);
        $columns->addColumn([$model->fireEdit($content->id)]);

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
                        AdminFormElement::text('name', 'Наименование'),
                        AdminFormElement::wysiwyg('descr', 'Контент', 'ckeditor'),
                        AdminFormElement::checkbox('activated', 'Актив.')->setDefaultValue(1)
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

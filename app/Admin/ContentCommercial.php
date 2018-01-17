<?php

use SleepingOwl\Admin\Model\ModelConfiguration;
use SleepingOwl\Admin\Form\FormElements;

//use AdminSection;

use App\ContentCommercial;
use App\ContentSimple;

AdminSection::registerModel(ContentCommercial::class, function (ModelConfiguration $model) {
    $model->setTitle('Коммерческие площади');

    $model->setRedirect(['create' => 'display', 'edit' => 'display']);

    // Display
    $model->onDisplay(function() {
        
        $table = AdminDisplay::datatables()->setModelClass(ContentCommercial::class)->setColumns([
            AdminColumn::order()->setLabel('Сортировка')->setHtmlAttribute('class', 'text-center')->setWidth('100px'),
            AdminColumn::link('name')->setLabel('Наименование'),
            AdminColumnEditable::checkbox('activated')->setLabel('Актив.')->setWidth('80px')->setHtmlAttribute('class', 'text-center')
        ]);
        $table->paginate(25);

        $table->setApply(function ($query) {
            $query->where('content_id', -7)->orderBy('order', 'asc');
        });

        $content = ContentCommercial::firstOrCreate(['content_id' => -6]);
        $columns = AdminFormElement::columns();
        $columns->addColumn([AdminSection::getModel(ContentSimple::class)->fireEdit($content->id)]);

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
                        AdminFormElement::hidden('content_id')->setDefaultValue(-7),
                        AdminFormElement::text('name', 'Наименование')->required(),
                        AdminFormElement::wysiwyg('descr', 'Контент', 'ckeditor'),
                        AdminFormElement::images('images', 'Image'),
                        AdminFormElement::checkbox('activated', 'Актив.')->setDefaultValue(1)
                    ];
                })
        );

        return $form;
    });

});

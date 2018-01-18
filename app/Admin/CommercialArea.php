<?php

use SleepingOwl\Admin\Model\ModelConfiguration;
use SleepingOwl\Admin\Form\FormElements;

//use AdminSection;

use App\CommercialArea;
use App\ContentSimple;

AdminSection::registerModel(CommercialArea::class, function (ModelConfiguration $model) {
    $model->setTitle('Коммерческие площади');

    $model->setRedirect(['create' => 'display', 'edit' => 'display']);

    // Display
    $model->onDisplay(function() {
        
        $table = AdminDisplay::datatables()->setModelClass(CommercialArea::class);
        $table->with('building');
        $table->setColumns([
            AdminColumn::image('image')->setLabel('Изображение')->setHtmlAttribute('class', 'text-center')->setWidth('100px'),
            AdminColumn::text('building.name')->setLabel('Здание'),
            AdminColumn::link('name')->setLabel('Наименование'),
            AdminColumnEditable::checkbox('activated')->setLabel('Актив.')->setWidth('80px')->setHtmlAttribute('class', 'text-center')
        ]);
        $table->paginate(25);

        $content = ContentSimple::firstOrCreate(['content_id' => -6]);
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
                        AdminFormElement::text('name', 'Наименование')->required(),
                        AdminFormElement::select('building_id', 'Здание', \App\Building::class)->setDisplay('name')->required(),
                        AdminFormElement::wysiwyg('descr', 'Контент', 'ckeditor'),
                        AdminFormElement::image('image', 'Image'),
                        AdminFormElement::checkbox('activated', 'Актив.')->setDefaultValue(1)
                    ];
                })
        );

        return $form;
    });

});

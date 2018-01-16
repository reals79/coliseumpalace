<?php

use SleepingOwl\Admin\Model\ModelConfiguration;
use SleepingOwl\Admin\Form\FormElements;

AdminSection::registerModel(\App\Apartment::class, function (ModelConfiguration $model) {
    $model->setTitle('Квартиры');

    $model->setRedirect(['create' => 'display', 'edit' => 'display']);

    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables();
        $display->with('building', 'apartmentType');
        $display->setColumns([
            //AdminColumn::order()->setLabel('Сортировка')->setHtmlAttribute('class', 'text-center')->setWidth('100px'),
            AdminColumn::image('image')->setLabel('Изображение')->setHtmlAttribute('class', 'text-center')->setWidth('100px'),
            AdminColumn::text('building.name')->setLabel('Здание'),
            AdminColumn::text('apartmentType.name')->setLabel('Тип квартиры'),
            AdminColumn::text('number_apartment')->setLabel('Номер квартиры')->setHtmlAttribute('class', 'text-center')->setWidth('50px'),
            AdminColumn::text('floor')->setLabel('Этаж')->setHtmlAttribute('class', 'text-center')->setWidth('30px'),
            AdminColumnEditable::checkbox('activated')->setLabel('Актив.')->setWidth('80px')->setHtmlAttribute('class', 'text-center')
        ]);

        $display->paginate(25);

        return $display;
    });

    // Create And Edit
   $model->onCreateAndEdit(function($id = null) {

        $form = AdminForm::panel();

        $form->addHeader(AdminFormElement::columns()
             ->addColumn([
                 AdminFormElement::select('building_id', 'Здание', \App\Building::class)->setDisplay('name')->required(),
             ])->addColumn([
                AdminFormElement::select('apartment_type_id', 'Тип квартиры', \App\ApartmentType::class)->setDisplay('name')->required(),
             ])
        );

        $form->addBody(AdminFormElement::columns()
             ->addColumn([
                 AdminFormElement::text('number_apartment', 'Номер квартиры')->required(),
             ])->addColumn([
                AdminFormElement::text('floor', 'Этаж')->required(),
             ])->addColumn([
                AdminFormElement::number('number_rooms', 'Количество комнат')->setMin(1)->setMax(10)->setDefaultValue(1),
             ])
        );

        $form->addBody([
            AdminFormElement::text('price', 'Цена'),
        ]);

        $form->addBody(
            AdminFormElement::columns()
                ->addColumn([
                        AdminFormElement::text('total_area', 'Общая площадь')->setDefaultValue(0),
                        AdminFormElement::text('living_area', 'Жилая площадь')->addValidationRule('numeric')->setDefaultValue(0),
                        AdminFormElement::text('hall', 'Прихожая')->addValidationRule('numeric')->setDefaultValue(0),
                        AdminFormElement::text('living_room', 'Гостиная')->addValidationRule('numeric')->setDefaultValue(0),
                        AdminFormElement::text('kitchen', 'Кухня')->addValidationRule('numeric')->setDefaultValue(0),
                        AdminFormElement::text('wardrobe', 'Гардеробная')->addValidationRule('numeric')->setDefaultValue(0),
                        AdminFormElement::text('terrace', 'Терраса')->addValidationRule('numeric')->setDefaultValue(0),
                ])->addColumn([
                    AdminFormElement::view('admin.dynamic-inputs', ['name' => 'bedrooms', 'label' => 'Спальни', 'value' => 0], function(\App\Apartment $model, Illuminate\Http\Request $request) {
                        if (!empty($request->bedrooms))
                            $bedrooms = array_filter($request->bedrooms, function($value) { return !empty($value); });
                        else $bedrooms = '';
                        $model->bedrooms = $bedrooms;
                    }),
                    AdminFormElement::view('admin.dynamic-inputs', ['name' => 'bathrooms', 'label' => 'Санузлы', 'value' => 0], function(\App\Apartment $model, Illuminate\Http\Request $request) {
                        if (!empty($request->bathrooms))
                            $bathrooms = array_filter($request->bathrooms, function($value) { return !empty($value); });
                        else $bathrooms = '';
                        $model->bathrooms = $bathrooms;
                    }),
                ])
        );

        $form->addBody([
            AdminFormElement::wysiwyg('notes', 'Заметка', 'ckeditor'),
        ]);

        $form->addFooter([
            AdminFormElement::image('image', 'Изображение'),
            AdminFormElement::checkbox('activated', 'Актив.')->setDefaultValue(1),
        ]);

        return $form;
    });

});

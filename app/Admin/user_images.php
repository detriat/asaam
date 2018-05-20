<?php

use App\User;
use App\Model\UserImages;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(UserImages::class, function (ModelConfiguration $model) {
    $model->setTitle('Снимки пользователей');
    $model->onDisplay(function () {

        $display = AdminDisplay::table()->setColumns([
            AdminColumn::link('id')->setLabel('Id')->setWidth('50px'),
            AdminColumn::custom('Пользователь', function (UserImages $image){
                $user = User::where('id_image', $image->id)->first();

                if (is_null($user)){
                    return 'Не известный пользователь';
                }

                return $user->first_name . ' '. $user->last_name;
            })->setWidth('300px'),
            AdminColumn::custom('Снимок', function (UserImages $image){
                return '<img src="/'.$image->name.'" class="thumb" alt="Фото, учавствующуе в конкурсе">';
            }),
        ]);

        $display->paginate(15);

        return $display;
    });

    $model->onCreateAndEdit(function() {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::image('name', 'Новый снимок')->required()
        );
        return $form;
    });

})->addMenuPage(UserImages::class, 10)->setIcon('fa fa-picture-o');

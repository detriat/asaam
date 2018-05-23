<?php

use App\User;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(User::class, function (ModelConfiguration $model) {
    $model->setTitle('Пользователи');
    $model->disableDeleting();

    $model->onDisplay(function () {

        $display = AdminDisplay::table()->setColumns([
            AdminColumn::link('id')->setLabel('Id')->setWidth('50px'),
            AdminColumn::link('first_name')->setLabel('Имя')->setWidth('200px'),
            AdminColumn::link('last_name')->setLabel('Фамилия')->setWidth('200px'),
            AdminColumn::link('email')->setLabel('Email')->setWidth('200px'),
            AdminColumn::link('city')->setLabel('Город/Страна')->setWidth('200px'),
            AdminColumn::link('network_profile')->setLabel('Профиль')->setWidth('200px'),
            AdminColumn::custom('Снимок', function (User $user){
                $image = \App\Model\UserImages::where('id', $user->id_image)->first();

                if (is_null($image)){
                    return;
                }

                $url = $image->name;

                return '<img src="/'.$url.'" class="thumb" alt="Фото, учавствующуе в конкурсе">';
            }),
            AdminColumn::link('ip')->setLabel('IP')->setWidth('200px'),
            AdminColumn::custom('Роль', function(User $user){
                return ($user->isWinner == 1) ? 'Побелитель' : 'Участник';
            }),
            AdminColumn::custom('Статус', function(User $user){
                return ($user->status == 1) ? 'Активен' : 'Забанен';
            })
            //AdminColumn::link('id_image')->setLabel('Снимок')->setWidth('200px'), //Вывести реальную картинку, а не её id
        ]);
        
        $display->paginate(15);
        
        return $display;
    });

    $model->onCreateAndEdit(function() {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('first_name', 'Имя')->required('Это поле не может быть пустым'),
            AdminFormElement::text('last_name', 'Фамилия')->required('Это поле не может быть пустым'),
            AdminFormElement::text('email', 'Email')->required('Это поле не может быть пустым'),
            AdminFormElement::text('city', 'Город')->required('Это поле не может быть пустым'),
            AdminFormElement::text('network', 'Социальная сеть')->required('Это поле не может быть пустым'),
            AdminFormElement::text('network_profile', 'Ссылка на профиль в социальной сети')->required('Это поле не может быть пустым'),
            AdminFormElement::text('ip', 'IP пользователя')->required('Это поле не может быть пустым'),
            AdminFormElement::select('status', 'Статус')->setOptions([
                0 => 'Забанен',
                1 => 'Активен'
            ])->required('Это поле не может быть пустым'),
            AdminFormElement::select('isWinner', 'Статус')->setOptions([
                0 => 'Участник',
                1 => 'Победитель'
            ])->required('Это поле не может быть пустым'),
            /*AdminFormElement::number('id_image', 'Снимок'),*/
            AdminFormElement::image('photo', 'Фото пользователя'),
            AdminFormElement::password('password', 'Пароль')->hashWithBcrypt()
        );
        return $form;
    });

})->addMenuPage(User::class, 9)->setIcon('fa fa-user-circle-o');

<?php

use App\Model\UserWinners;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(UserWinners::class, function (ModelConfiguration $model) {

    $model->setTitle('Победители');
    $model->setAlias('users/winners');

    $model->disableCreating();
    $model->disableDeleting();
    $model->disableEditing();

    $model->onDisplay(function () {

        $display = AdminDisplay::table()->setColumns([
            AdminColumn::link('id')->setLabel('Id')->setWidth('50px'),
            AdminColumn::link('first_name')->setLabel('Имя')->setWidth('200px'),
            AdminColumn::link('last_name')->setLabel('Фамилия')->setWidth('200px'),
        ]);

        $display->paginate(15);
        $display->getScopes()->push(['Winners', 1]);
        return $display;
    });


})->addMenuPage(UserWinners::class, 12)->setIcon('fa fa-user-circle-o');

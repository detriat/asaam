<?php

use App\User;
use App\Model\UserBlackList;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(UserBlackList::class, function (ModelConfiguration $model) {

    $model->setTitle('Черный список');
    $model->setAlias('users/black_list');

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
        $display->getScopes()->push(['Banned', 0]);
        return $display;
    });


})->addMenuPage(UserBlackList::class, 11)->setIcon('fa fa-user-circle-o');

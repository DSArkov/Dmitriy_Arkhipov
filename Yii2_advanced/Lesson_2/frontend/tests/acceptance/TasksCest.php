<?php

//Регистрируем класс в пространстве имён.
namespace frontend\tests\acceptance;

//Импортируем класс.
use frontend\tests\AcceptanceTester;


/**
 * Приёмочный тест.
 * Class TasksCest
 * @package frontend\tests\acceptance
 */
class TasksCest
{
    /**
     * Проверяем авторизацию.
     * @param AcceptanceTester $I
     */
    public function loginSuccess(AcceptanceTester $I)
    {
        $I->amOnUrl('http://task.local/site/login');
        $I->wait(2);

        $I->appendField('#loginform-username', 'admin');
        $I->wait(1);

        $I->appendField('#loginform-password', 'qwerty');
        $I->wait(1);

        $I->click('.btn-primary[type=submit]');
        $I->wait(2);
    }

    /**
     * Проверяем возможность создания новой задачи.
     * @param AcceptanceTester $I
     */
    public function createTask(AcceptanceTester $I)
    {
        $I->amOnUrl('http://task.local');
        $I->see('My Application');
        $I->wait(2);

        $I->seeLink('Get started');
        $I->click('Get started');
        $I->wait(2);

        $I->seeLink('Create task');
        $I->click('Create task');
        $I->wait(2);

        $I->appendField('#tasks-title', 'Test task');
        $I->wait(1);

        $I->click('#tasks-responsible_id');
        $I->wait(1);
        $I->click('#tasks-responsible_id > option:nth-child(3)');
        $I->wait(1);

        $I->click('#tasks-status_id');
        $I->wait(1);
        $I->click('#tasks-status_id > option:nth-child(1)');
        $I->wait(1);

        $I->appendField('#tasks-description', 'Test task description...');
        $I->wait(1);

        $I->click('.btn-success[type=submit]');
        $I->wait(10);
    }
}
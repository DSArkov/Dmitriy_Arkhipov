<?php

//Регистрируем класс в пространстве имен.
namespace app\controllers;

//Используем классы:
use app\base\App;
use app\models\repositories\LoginRepository;


//Контроллер для работы с аутентификацией.
class LoginController extends Controller
{
    /**
     * Метод выводит информацию о пользователе на экран.
     */
    public function actionIndex()
    {
        //Запускаем сессию или используем существующую.
        $session = App::call()->session;
        //Создаём экземпляр класса "Request", либо используем существующий.
        $request = App::call()->request;

        //Создаем переменную для хранения сообщения об ошибке.
        $message = '';

        //Проверяем пришли ли нам данные методом POST.
        if ($request->isPost()) {
            //Получаем login из запроса.
            $login = $request->post('login');
            //Получаем password из запроса.
            $password = $request->post('password');
            //Проверяем совпадает ли пара логин/пароль с теми, что есть в базе.
            if ($user = (new LoginRepository())->getUserByLoginPass($login, $password)) {
                //Очищаем массив на случай, если в нем уже содержаться какие-то данные.
                //TODO: Очистка сессиии.
                $_SESSION = [];
                //Записываем id в сессию.
                $session->set(['users', 'id'], $user['id']);
                //$_SESSION['users']['id'] = $user['id'];
                //Записываем логин для отображения приветствия.
                $session->set(['users', 'login'], $login);
                //$_SESSION['users']['login'] = $login;
                //Переходим на главную страницу.
                header('Location: /product');
            }
            //Если данные не совпали - выводим сообщение.
            $message = 'Неправильная пара логин/пароль';
        }

        //Отрисовываем шаблон передавая параметры методу render.
        echo $this->render('login', ['message' => $message, 'login' => $session->get('users')['login']]);
    }

    /**
     * Метод очищает сессию и делает переадресацию на страницу каталога.
     */
    public function actionLogout()
    {
        //Очищааем сессию.
        App::call()->session->delete();
        //Делаем переадресацию на каталог.
        header('Location: /product');
    }
}
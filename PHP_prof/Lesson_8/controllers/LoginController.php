<?php

//Регистрируем класс в пространстве имен "app\controllers".
namespace app\controllers;

//Используем классы:
use app\base\App;
use app\models\repositories\LoginRepository;
use app\models\User;


//Задача контроллера - принятие решения.
//Контроллер "User" наследуется от абстрактного класса "Controller".
class LoginController extends Controller
{
    /**
     * Метод выводит информацию о пользователе на экран.
     */
    public function actionIndex() {
//        //В случае, если мы не хотим отображать layout ->
//        //$this -> useLayout = false;
//
//        //Получаем id запрашиваемого продукта.
//        $id = App::call() -> request -> get('id');
//        //Получаем объект пользователя.
//        $model = User::getObject($id);

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
                //TODO: session methods
                $_SESSION = [];
                //Записываем id в сессию.
                $_SESSION['users']['id'] = $user['id'];
                //И логин для отображения приветствия.
                $_SESSION['users']['login'] = $login;
                //Обновляем страницу.
                header('Location: /product');
            }

            //Если данные не совпали - выводим сообщение.
            $message = 'Неправильная пара логин/пароль';
        }
        $_SESSION = [];

        //Отрисовываем шаблон передавая параметры функции render.
        echo $this->render('login', ['message' => $message]);
    }
}
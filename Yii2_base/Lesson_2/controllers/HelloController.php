<?php
//Регистрируем класс в пространстве имён.
namespace app\controllers;

//Импортируем класс.
use yii\web\Controller;


//Контроллер для отображения приветствия пользователю.
class HelloController extends Controller
{
    /**
     * Метод вызывает на рендеринг шаблон "index".
     * @return string - Возвращает данные для вывода на экран.
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'title' => 'Hello page',
            'name' => 'user'
        ]);
    }
}
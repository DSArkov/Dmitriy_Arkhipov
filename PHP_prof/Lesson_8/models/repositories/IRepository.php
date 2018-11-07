<?php

//Регистрируем класс в пространстве имён.
namespace app\models\repositories;

//Используем класс:
use app\models\DataEntity;


//Создаем интерфейс, который указывает, какие методы должены реализовать зависимые классы.
interface IRepository
{
    public function getTableName();

    public function getEntityClass();

    public function getOne($id);

    public function getAll();

    public function getObject($id);

    public function getAllObjects();

    public function insert(DataEntity $entity);

    public function update(DataEntity $entity);

    public function save(DataEntity $entity);

    public function delete(DataEntity $entity);
}
<?php

//Регистрируем класс в пространстве имён.
namespace app\models\forms;

//Импортируем классы.
use yii\base\Model;
use app\models\tables\TaskAttachments;
use yii\imagine\Image;
use yii\web\UploadedFile;


//Класс отвечает за сохранение загруженных пользователем файлов.
class TaskAttachmentsAddForm extends Model
{
    public $taskId;
    /** @var UploadedFile*/
    public $file;

    protected $originalDir = '@img/tasks/';
    protected $copiesDir = '@img/tasks/small/';

    protected $filename;
    protected $filepath;

    protected $model;

    public function rules()
    {
        return [
            [['taskId', 'file'], 'required'],
            [['taskId'], 'integer'],
            [['file'], 'file', 'extensions' => ['jpg', 'png']],
        ];
    }

    /**
     * Метод отвечает за корректное сохранение загруженного файла.
     * @return bool
     * @throws \yii\base\Exception
     */
    public function save()
    {
        if ($this->validate()) {
            $this->saveUploadedFile();
            $this->createMinCopy();
            return $this->saveData();
        }
        return false;
    }

    /**
     * Метод сохраняет данные о загруженном файле в БД.
     * @return bool
     */
    protected function saveData()
    {
        $this->model = new TaskAttachments([
            'task_id' => $this->taskId,
            'path' => $this->filename
        ]);
        return $this->model->save();

    }

    /**
     * Метод отвечает за физическое сохранение файла на сервере.
     * @throws \yii\base\Exception
     */
    protected function saveUploadedFile()
    {
        $this->filename = \Yii::$app->getSecurity()->generateRandomString(12)
            . "." . $this->file->getExtension();
        $this->filepath = \Yii::getAlias("{$this->originalDir}{$this->filename}");
        $this->file->saveAs($this->filepath);
    }

    /**
     * Метод создаёт уменьшенную копию и сохраняет её в указанной директории.
     */
    protected function createMinCopy()
    {
        Image::thumbnail($this->filepath, 100, 100)
            ->save(\Yii::getAlias("{$this->copiesDir}{$this->filename}"));
    }
}
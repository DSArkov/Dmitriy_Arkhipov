<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\Project;
use common\models\tables\Tasks;

/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $tasks */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;

\frontend\assets\ProjectListAssert::register($this);
?>

<h1><?= Html::encode($this->title) ?></h1>

<a href="<?= Url::to(['project/create']) ?>" class="btn btn-primary">Create project</a>

<?= \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => function ($model) {
        return Project::widget(['model' => $model]);
    },
    'viewParams' => [
        'tasks' => Tasks::find()->where(['project_id' => $dataProvider->key])->count(),
    ],
    'summary' => false,
    'options' => [
        'class' => 'preview-container'
    ]
]); ?>


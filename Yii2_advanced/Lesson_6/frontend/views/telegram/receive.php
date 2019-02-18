<?php

/* @var $messages */

$script = <<<JS
setInterval(function() {
  $('#btn-refresh').click();
}, 3000);
JS;

$this->registerJs($script);

\yii\widgets\Pjax::begin();
?>

<div class="container">
    <div class="row">
        <div class="col-sm-2">
            <?php
            echo \yii\helpers\Html::a('Refresh', '/telegram/receive', [
                'id' => 'btn-refresh',
                'class' => 'btn btn-success'
            ]); ?>
        </div>
        <div class="col-sm-10">
            <h4>Telegram chat</h4>
            <hr>
            <?php
            foreach ($messages as $message): ?>
                <div>
                    <strong><?= $message['username'] ?>: </strong>
                    <?= $message['text'] ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php \yii\widgets\Pjax::end() ?>

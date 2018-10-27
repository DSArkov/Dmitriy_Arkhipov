<?php /** @var \app\models\Product $model */?>

<? foreach ($model as $product): ?>
<div>
    <h1><?=$product -> title?></h1>
    <p><?=$product -> description?></p>
    <h3><?=$product -> price?></h3>
</div>
<? endforeach; ?>
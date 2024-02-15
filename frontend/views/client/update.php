<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Client $model */
/** @var array $clubs */

$this->title = 'Update Client: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="client-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'clubs' => $clubs,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Client $model */
/** @var array $clubs */

$this->title = 'Create Client';
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'clubs' => $clubs,
    ]) ?>

</div>

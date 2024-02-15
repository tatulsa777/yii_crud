<?php

use backend\models\Client;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\ClientSearch $searchModel */
/** @var backend\models\Club $availableClubs */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Clients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Client', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'full_name',
            'gender',
            'birth_date',
            [
                'label' => 'Available Clubs',
                'value' => function ($model) use ($availableClubs) {
                    $clubs = isset($availableClubs[$model->id]) ? $availableClubs[$model->id] : [];
                    return implode(', ', array_map(function ($club) {
                        return Html::encode($club->name);
                    }, $clubs));
                },
                'format' => 'html',
            ],
            'creation_date',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Client $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

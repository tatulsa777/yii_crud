<?php

namespace frontend\controllers;

use backend\models\Client;
use backend\models\ClientClub;
use backend\models\ClientSearch;
use backend\models\Club;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientController implements the CRUD actions for Client model.
 */
class ClientController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors(): array
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Client models.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new ClientSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $clients = Client::find()->all();

        $availableClubs = [];

        foreach ($clients as $client) {
            $availableClubs[$client->id] = $client->getClubs()->all();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'availableClubs' => $availableClubs,
        ]);
    }

    /**
     * Displays a single Client model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Client model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Client();

        $clubs = Club::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $selectedClubIds = Yii::$app->request->post('Client')['club_ids'];

            if (!empty($selectedClubIds)) {
                foreach ($selectedClubIds as $clubId) {
                    $client_club = new ClientClub();
                    $client_club->club_id = $clubId;
                    $client_club->client_id = $model->id;
                    $client_club->save();
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'clubs' => ArrayHelper::map($clubs, 'id', 'name'),
        ]);
    }

    /**
     * Updates an existing Client model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $clubs = Club::find()->all();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $selectedClubIds = Yii::$app->request->post('Client')['club_ids'];

            ClientClub::deleteAll(['client_id' => $model->id]);

            if (!empty($selectedClubIds)) {
                foreach ($selectedClubIds as $clubId) {
                    $client_club = new ClientClub();
                    $client_club->club_id = $clubId;
                    $client_club->client_id = $model->id;
                    $client_club->save();
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'clubs' => ArrayHelper::map($clubs, 'id', 'name'),
        ]);
    }

    /**
     * Deletes an existing Client model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Client model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Client the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Client::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace app\controllers;

use Yii;
use app\models\FormData;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class FormDataController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $model = new FormData();
        $model->is_delete = 0;

        if ($model->load(Yii::$app->request->post())) {

            $model->data = json_encode([
                'keluhan' => $model->keluhan,
                'anamnesis' => $model->anamnesis,
            ]);

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id_form_data]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        if ($model->data) {
            $json = json_decode($model->data, true);
            $model->keluhan = $json['keluhan'] ?? null;
            $model->anamnesis = $json['anamnesis'] ?? null;
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->data) {
            $json = json_decode($model->data, true);
            $model->keluhan = $json['keluhan'] ?? null;
            $model->anamnesis = $json['anamnesis'] ?? null;
        }

        if ($model->load(Yii::$app->request->post())) {

            $model->data = json_encode([
                'keluhan' => $model->keluhan,
                'anamnesis' => $model->anamnesis,
            ]);

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id_form_data]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = FormData::findOne(['id_form_data' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Data tidak ditemukan.');
    }
}

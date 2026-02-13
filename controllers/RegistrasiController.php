<?php

namespace app\controllers;

use Yii;
use app\models\Registrasi;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class RegistrasiController extends Controller
{
    /**
     * Behaviors
     */
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

    /**
     * INDEX - List Data
     */
    public function actionIndex()
    {
        $data = Registrasi::find()
            ->orderBy(['id_registrasi' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'data' => $data,
        ]);
    }

    /**
     * CREATE
     */
    public function actionCreate()
    {
        $model = new Registrasi();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'Data registrasi berhasil disimpan.');


            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * VIEW
     */
    public function actionView($id_registrasi)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_registrasi),
        ]);
    }

    /**
     * UPDATE
     */
    public function actionUpdate($id_registrasi)
    {
        $model = $this->findModel($id_registrasi);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'Data registrasi berhasil diupdate.');

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * DELETE
     */
    public function actionDelete($id_registrasi)
    {
        $this->findModel($id_registrasi)->delete();

        return $this->redirect(['index']);
    }

    /**
     * FIND MODEL
     */
    protected function findModel($id_registrasi)
    {
        if (($model = Registrasi::findOne($id_registrasi)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Data tidak ditemukan.');
    }
}

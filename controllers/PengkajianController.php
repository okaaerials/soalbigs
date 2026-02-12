<?php

namespace app\controllers;

use Yii;
use app\models\Pengkajian;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

class PengkajianController extends Controller
{
    /**
     * Lists all Pengkajian records
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Pengkajian::find()->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pengkajian model
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pengkajian model
     * Accept id_registrasi from button
     */
    public function actionCreate($id_registrasi = null)
    {
        $model = new Pengkajian();

        $model->tanggal_pengkajian = date('Y-m-d');
        $model->jam_pengkajian = date('H:i');
        // If coming from Registrasi page
        if ($id_registrasi !== null) {
            $model->id_registrasi = $id_registrasi;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'Pengkajian berhasil disimpan.');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pengkajian model
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'Pengkajian berhasil diperbarui.');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pengkajian model
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', 'Pengkajian berhasil dihapus.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pengkajian model by ID
     */
    protected function findModel($id)
    {
        if (($model = Pengkajian::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Data tidak ditemukan.');
    }
}

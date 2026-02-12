<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Registrasi;

/**
 * RegistrasiSearch represents the model behind the search form of `app\models\Registrasi`.
 */
class RegistrasiSearch extends Registrasi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_registrasi', 'no_registrasi', 'no_rekam_medis', 'nik', 'create_by', 'update_by'], 'integer'],
            [['nama_pasien', 'tanggal_lahir', 'create_time_at', 'update_time_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Registrasi::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_registrasi' => $this->id_registrasi,
            'no_registrasi' => $this->no_registrasi,
            'no_rekam_medis' => $this->no_rekam_medis,
            'tanggal_lahir' => $this->tanggal_lahir,
            'nik' => $this->nik,
            'create_by' => $this->create_by,
            'create_time_at' => $this->create_time_at,
            'update_by' => $this->update_by,
            'update_time_at' => $this->update_time_at,
        ]);

        $query->andFilterWhere(['ilike', 'nama_pasien', $this->nama_pasien]);

        return $dataProvider;
    }
}

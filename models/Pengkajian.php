<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Pengkajian extends ActiveRecord
{
    /* =========================================
     * VIRTUAL ATTRIBUTES (SEMUA FIELD FORM)
     * ========================================= */

    public $tanggal_pengkajian;
    public $jam_pengkajian;
    public $poliklinik;
    public $cara_masuk;
    public $anamnesis;
    public $diperoleh;
    public $hubungan;
    public $alergi;
    public $keluhan;
    public $keadaan_umum;
    public $warna_kulit;
    public $kesadaran;
    public $td;
    public $nadi;
    public $rr;
    public $suhu;
    public $alatbantu;
    public $prothesa;
    public $cacattubuh;
    public $adl;
    public $berat_badan;
    public $tinggi_badan;
    public $panjang_badan;
    public $lingkar_kepala;
    public $imt;
    public $status_gizi;
    public $riwayat_penyakit_sekarang;
    public $riwayat_penyakit_sebelumnya;
    public $riwayat_penyakit;
    public $riwayat_penyakit_keluarga;
    public $riwayat_operasi;
    public $operasi_apa;
    public $kapan_dioperasi;
    public $riwayat_pernah_dirawat_di_rs;
    public $penyakit_apa;
    public $kapan_dirawat_di_rs;
    public $resiko1;
    public $resiko2;
    public $resiko3;
    public $resiko4;
    public $resiko5;
    public $resiko6;
    public $total_resiko;


    /* ========================================= */

    public static function tableName()
    {
        return 'data_form';
    }

    /* =========================================
     * RULES
     * ========================================= */
    public function rules()
    {
        return [
            [['id_form', 'id_registrasi', 'create_by', 'update_by'], 'integer'],
            [['is_delete'], 'boolean'],
            [['create_time_at', 'update_time_at'], 'safe'],

            // JSON column
            [['data'], 'safe'],

            // Semua field form otomatis safe
            [array_keys($this->getJsonAttributes()), 'safe'],

            [['id_registrasi'], 'exist',
                'skipOnError' => true,
                'targetClass' => Registrasi::class,
                'targetAttribute' => ['id_registrasi' => 'id_registrasi']
            ],
        ];
    }

    /* =========================================
     * LIST FIELD YANG MASUK JSON
     * ========================================= */
    protected function getJsonAttributes()
    {
        return [
            'tanggal_pengkajian',
            'jam_pengkajian',
            'poliklinik',
            'cara_masuk',
            'anamnesis',
            'diperoleh',
            'hubungan',
            'alergi',
            'keluhan',
            'keadaan_umum',
            'warna_kulit',
            'kesadaran',
            'td',
            'nadi',
            'rr',
            'suhu',
            'alatbantu',
            'prothesa',
            'cacattubuh',
            'adl',
            'berat_badan',
            'tinggi_badan',
            'panjang_badan',
            'lingkar_kepala',
            'imt',
            'status_gizi',
            'riwayat_penyakit_sekarang',
            'riwayat_penyakit_sebelumnya',
            'riwayat_penyakit',
            'riwayat_penyakit_keluarga',
            'riwayat_operasi',
            'operasi_apa',
            'kapan_dioperasi',
            'riwayat_pernah_dirawat_di_rs',
            'penyakit_apa',
            'kapan_dirawat_di_rs',
        ];
    }

    /* =========================================
     * AFTER FIND → Decode JSON otomatis
     * ========================================= */
    public function afterFind()
    {
        parent::afterFind();

        if (!empty($this->data)) {
            $json = json_decode($this->data, true);

            if (is_array($json)) {
                foreach ($json as $key => $value) {
                    if (property_exists($this, $key)) {
                        $this->$key = $value;
                    }
                }
            }
        }
    }

    /* =========================================
     * BEFORE SAVE → Encode otomatis semua field
     * ========================================= */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $jsonData = [];

        foreach ($this->getJsonAttributes() as $attribute) {
            $jsonData[$attribute] = $this->$attribute;
        }

        $this->data = json_encode($jsonData);

        // Audit
        if (!Yii::$app->user->isGuest) {

            if ($this->isNewRecord) {
                $this->create_by = Yii::$app->user->id;
                $this->create_time_at = new Expression('NOW()');
            }

            $this->update_by = Yii::$app->user->id;
            $this->update_time_at = new Expression('NOW()');
        }

        return true;
    }

    /* =========================================
     * RELATION
     * ========================================= */
    public function getRegistrasi()
    {
        return $this->hasOne(Registrasi::class, ['id_registrasi' => 'id_registrasi']);
    }
}

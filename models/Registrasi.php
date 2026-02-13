<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "registrasi".
 *
 * @property int $id_registrasi
 * @property int|null $no_registrasi
 * @property int|null $no_rekam_medis
 * @property string|null $nama_pasien
 * @property string|null $tanggal_lahir
 * @property int|null $nik
 * @property int|null $create_by
 * @property string|null $create_time_at
 * @property int|null $update_by
 * @property string|null $update_time_at
 *
 * @property DataForm[] $dataForms
 */
class Registrasi extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registrasi';
    }

    public static function primaryKey()
    {
        return ['id_registrasi'];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_registrasi', 'no_rekam_medis', 'nama_pasien', 'tanggal_lahir', 'nik', 'create_by', 'create_time_at', 'update_by', 'update_time_at'], 'default', 'value' => null],
            [['no_registrasi', 'no_rekam_medis', 'nik', 'create_by', 'update_by'], 'default', 'value' => null],
            [['no_registrasi', 'no_rekam_medis', 'nik', 'create_by', 'update_by'], 'integer'],
            [['tanggal_lahir', 'create_time_at', 'update_time_at'], 'safe'],
            [['nama_pasien'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_registrasi' => 'ID Registrasi',
            'no_registrasi' => 'No Registrasi',
            'no_rekam_medis' => 'No Rekam Medis',
            'nama_pasien' => 'Nama Pasien',
            'tanggal_lahir' => 'Tanggal Lahir',
            'nik' => 'Nik',
            'create_by' => 'Create By',
            'create_time_at' => 'Create Time At',
            'update_by' => 'Update By',
            'update_time_at' => 'Update Time At',
        ];
    }

    /**
     * Gets query for [[DataForms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataForms()
    {
        return $this->hasMany(DataForm::class, ['id_registrasi' => 'id_registrasi']);
    }

    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
    
            if (!Yii::$app->user->isGuest) {
    
                if ($this->isNewRecord) {
                    $this->create_by = Yii::$app->user->identity->id;
                }
    
                $this->update_by = Yii::$app->user->identity->id;
            }
    
            return true;
        }
        return false;
    }



    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'create_time_at',
                'updatedAtAttribute' => 'update_time_at', // optional
                'value' => new Expression('NOW()'), // PostgreSQL
            ],
        ];
    }

    // public function rules()
    // {
    //     return [
    //         [['no_registrasi', 'no_rekam_medis'], 'required'],

    //         [['no_registrasi', 'no_rekam_medis'], 'string', 'max' => 8],

    //         [['no_registrasi', 'no_rekam_medis'], 'match', 
    //             'pattern' => '/^[0-9]+$/',
    //             'message' => 'Hanya boleh angka.'
    //         ],

    //         [['nama_pasien'], 'string', 'max' => 255],
    //         [['tanggal_lahir', 'create_time_at', 'update_time_at'], 'safe'],
    //         [['nik', 'create_by', 'update_by'], 'integer'],
    //     ];
    // }

}

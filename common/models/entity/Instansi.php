<?php

namespace common\models\entity;

use Yii;

/**
 * This is the model class for table "instansi".
 *
 * @property int $id
 * @property string $nama_instansi
 *
 * @property User[] $users
 */
class Instansi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'instansi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_instansi'], 'required'],
            [['nama_instansi'], 'string', 'max' => 191],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_instansi' => 'Nama Instansi',
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['instansi_id' => 'id']);
    }
}

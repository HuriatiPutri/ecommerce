<?php

namespace common\models\entity;

use Yii;

/**
 * This is the model class for table "costumer".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $password
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property DetailPesan[] $detailPesans
 * @property DetailPesan[] $detailPesans0
 * @property Pesan[] $pesans
 */
class Costumer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
            \yii\behaviors\BlameableBehavior::className(),
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'costumer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'phone', 'email', 'password'], 'required'],
            [['address', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'string'],
            [['name', 'phone', 'email', 'password'], 'string', 'max' => 225],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'email' => 'Email',
            'password' => 'Password',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPesans()
    {
        return $this->hasMany(DetailPesan::className(), ['costumer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPesans0()
    {
        return $this->hasMany(DetailPesan::className(), ['costumer_address' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesans()
    {
        return $this->hasMany(Pesan::className(), ['costumer_id' => 'id']);
    }
}

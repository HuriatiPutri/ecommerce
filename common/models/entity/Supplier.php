<?php

namespace common\models\entity;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $password
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property BrgMasuk[] $brgMasuks
 */
class Supplier extends \yii\db\ActiveRecord
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
        return 'supplier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'phone', 'email', 'password'], 'required'],
            [['address'], 'string'],
            [['created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
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
    public function getBrgMasuks()
    {
        return $this->hasMany(BrgMasuk::className(), ['supplier_id' => 'id']);
    }
}

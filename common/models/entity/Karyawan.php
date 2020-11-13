<?php

namespace common\models\entity;

use Yii;

/**
 * This is the model class for table "empp".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $position
 * @property string $email
 * @property string $password
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 */
class Karyawan extends \yii\db\ActiveRecord
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
        return 'empp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'position', 'email', 'password'], 'required'],
            [['address', 'position'], 'string'],
            [['created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name', 'email', 'password'], 'string', 'max' => 225],
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
            'position' => 'Position',
            'email' => 'Email',
            'password' => 'Password',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}

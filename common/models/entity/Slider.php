<?php

namespace common\models\entity;

use Yii;

/**
 * This is the model class for table "slider".
 *
 * @property integer $id
 * @property string $foto
 * @property integer $status
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $updated_at
 */
class Slider extends \yii\db\ActiveRecord
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
        return 'slider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['status', 'created_at', 'created_by', 'updated_by', 'updated_at'], 'integer'],
            [['foto'], 'string', 'max' => 225],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'foto' => 'Foto',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }
     public static function uploadableFields()
    {
        return [
            'foto'
        ];
    }
    public function saveFile($uploadedFile, $file)
    {
        $filename  = $this->id .'.'. $uploadedFile->extension;
        $directory = Yii::getAlias('@uploads/'.$this->tableName().'/'.$file);
        if (!file_exists($directory)) mkdir($directory, 0777, true);
        $uploadedFile->saveAs($directory.'/'.$filename);
        $this->$file = $filename;
        $this->save();
    }

    public function downloadFile($field)
    {
        if ($this->$field) {
            $filepath  = Yii::getAlias('@uploads/' . $this->tableName().'/'.$field.'/'.$this->$field);
            $array     = explode('.', $this->$field);
            $extension = end($array);
            $filename  = $this->foto . '.' . $extension;
            if (file_exists($filepath)) return Yii::$app->response->sendFile($filepath, $filename, ['inline' => true]);
        }
        return false;
    }
}

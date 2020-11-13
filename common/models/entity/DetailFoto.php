<?php

namespace common\models\entity;

use Yii;

/**
 * This is the model class for table "detail_foto".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $foto
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $updated_at
 *
 * @property Product $product
 */
class DetailFoto extends \yii\db\ActiveRecord
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
        return 'detail_foto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id', 'created_at', 'created_by', 'updated_by', 'updated_at'], 'integer'],
            [['foto'], 'string', 'max' => 225],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product',
            'foto' => 'Foto',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
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

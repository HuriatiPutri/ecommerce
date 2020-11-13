<?php

namespace common\models\entity;

use Yii;
use common\models\entity\FotoDetail;
use common\models\entity\Wishlist;


/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property integer $price
 * @property string $desc
 * @property string $mainImage
 * @property int $stock
 * @property integer $category_id
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{
      // use \mdm\behaviors\ar\RelationTrait;

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
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price', 'desc','stock','category_id'], 'required'],
            [['price', 'category_id','stock', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['desc', 'mainImage'], 'string'],
            [['name'], 'string', 'max' => 225],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'price' => 'Price',
            'desc' => 'Desc',
            'mainImage' => 'Main Image',
            'stock' => 'Stock',
            'category_id' => 'Category',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public static function uploadableFields()
    {
        return [
            'mainImage'
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
            $filename  = $this->mainImage . '.' . $extension;
            if (file_exists($filepath)) return Yii::$app->response->sendFile($filepath, $filename, ['inline' => true]);
        }
        return false;
    }
    public function onWishList(){
If(Yii::$app->user->identity != Null){
        $model = Wishlist::findOne(['product_id'=>$this->id,'user_id'=>Yii::$app->user->identity->id]);
        if($model != null)
            return true;
        else
            return false;
    }else{
 return false;
}
}
    /**
     * @return \yii\db\ActiveQuery
     */
 //    public function getFotoDetails()
 //    {
 //        return $this->hasMany(FotoDetail::className(), ['product_id' => 'id']);
 //    }
 // public function setFotoDetails($value)
 //    {
 //        $this->loadRelated('FotoDetails', $value);
 //    }
 
}

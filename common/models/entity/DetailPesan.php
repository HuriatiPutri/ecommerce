<?php

namespace common\models\entity;

use Yii;

/**
 * This is the model class for table "detail_pesan".
 *
 * @property integer $id
 * @property integer $pesan_id
 * @property integer $product_id
 * @property integer $qty
 * @property string $ukuran
 * @property string $warna
 * @property integer $pesan_total
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property Pesan $pesan
 * @property Product $product
 */
class DetailPesan extends \yii\db\ActiveRecord
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
        return 'detail_pesan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pesan_id', 'product_id', 'qty', 'pesan_total'], 'required'],
            [['pesan_id', 'product_id', 'qty', 'pesan_total','ukuran','warna', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['pesan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pesan::className(), 'targetAttribute' => ['pesan_id' => 'id']],
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
            'pesan_id' => 'Pesan',
            'product_id' => 'Product',
            'qty' => 'Qty',
            'ukuran' =>'Ukuran',
            'warna' =>'Warna',
            'pesan_total' => 'Pesan Total',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesan()
    {
        return $this->hasOne(Pesan::className(), ['id' => 'pesan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}

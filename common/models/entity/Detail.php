<?php

namespace common\models\entity;

use Yii;

/**
 * This is the model class for table "detail_pesan".
 *
 * @property integer $id
 * @property integer $pesan_id
 * @property integer $costumer_id
 * @property integer $costumer_address
 * @property integer $product_id
 * @property integer $pesan_total
 * @property integer $pesan_paid
 * @property string $date
 * @property string $status
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property Pesan $pesan
 * @property Costumer $costumer
 * @property Costumer $costumerAddress
 * @property Product $product
 * @property Pesan $pesanTotal
 * @property Pesan $pesanPa
 */
class Detail extends \yii\db\ActiveRecord
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
            [['pesan_id', 'costumer_id', 'costumer_address', 'product_id', 'pesan_total', 'pesan_paid', 'date', 'status'], 'required'],
            [['pesan_id', 'costumer_id', 'costumer_address', 'product_id', 'pesan_total', 'pesan_paid', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['date'], 'safe'],
            [['status'], 'string'],
            [['pesan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pesan::className(), 'targetAttribute' => ['pesan_id' => 'id']],
            [['costumer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Costumer::className(), 'targetAttribute' => ['costumer_id' => 'id']],
            [['costumer_address'], 'exist', 'skipOnError' => true, 'targetClass' => Costumer::className(), 'targetAttribute' => ['costumer_address' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['pesan_total'], 'exist', 'skipOnError' => true, 'targetClass' => Pesan::className(), 'targetAttribute' => ['pesan_total' => 'id']],
            [['pesan_paid'], 'exist', 'skipOnError' => true, 'targetClass' => Pesan::className(), 'targetAttribute' => ['pesan_paid' => 'id']],
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
            'costumer_id' => 'Costumer',
            'costumer_address' => 'Costumer Address',
            'product_id' => 'Product',
            'pesan_total' => 'Pesan Total',
            'pesan_paid' => 'Pesan Paid',
            'date' => 'Date',
            'status' => 'Status',
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
    public function getCostumer()
    {
        return $this->hasOne(Costumer::className(), ['id' => 'costumer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCostumerAddress()
    {
        return $this->hasOne(Costumer::className(), ['id' => 'costumer_address']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesanTotal()
    {
        return $this->hasOne(Pesan::className(), ['id' => 'pesan_total']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesanPa()
    {
        return $this->hasOne(Pesan::className(), ['id' => 'pesan_paid']);
    }
}

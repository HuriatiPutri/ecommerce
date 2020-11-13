<?php

namespace common\models\entity;

use Yii;

/**
 * This is the model class for table "pesan".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $nama_penerima
 * @property string $no_telp
 * @property string $provinsi_asal
 * @property string $provinsi_tujuan
 * @property string $kota_asal
 * @property string $kota_tujuan
 * @property string $jln
 * @property string $kurir
 * @property string $kodepos
 * @property string $ongkir
 * @property integer $berat
 * @property integer $paid
 * @property string $date
 * @property integer $status
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property DetailPesan[] $detailPesans
 * @property User $user
 */
class Pesan extends \yii\db\ActiveRecord
{
     public $kotaasal, $kotatujuan;
    const CART = 0;
    const CHECKOUT = 1;
    const BAYAR = 2;
    const SELESAI = 3;

 public static function statusTypes($index = 'all', $html = false)
    {
        $array = [
            self::CART => 'Dalam keranjang',
            self::CHECKOUT => 'Checkout',
            self::BAYAR => 'Bayar',
            self::SELESAI => 'Selesai',
        ];
        if ($html) $array = [
            self::CART => '<span class="text-bold text-default">Dalam keranjang</span>',
            self::CHECKOUT => '<span class="text-bold text-warning">Checkout</span>',
            self::BAYAR => '<span class="text-bold text-info">Bayar</span>',
            self::SELESAI => '<span class="text-bold text-success">Selesai</span>',
        ];
        if (isset($array[$index])) return $array[$index];
        if ($index === 'all') return $array;
        return null;
    }
    public function getStatusTypeText($html = false)
    {
        return self::statusTypes($this->status, $html);
    }
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
        return 'pesan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'paid', 'date'], 'required'],
            [['user_id', 'berat', 'paid', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'total'], 'integer'],
            [['date','kotaasal','kotatujuan'], 'safe'],
            [['nama_penerima', 'no_telp', 'provinsi_asal', 'provinsi_tujuan', 'kota_asal', 'kota_tujuan', 'jln', 'kurir', 'kodepos', 'ongkir'], 'string', 'max' => 225],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'nama_penerima' => 'Nama Penerima',
            'no_telp' => 'No Telp',
            'provinsi_asal' => 'Provinsi Asal',
            'provinsi_tujuan' => 'Provinsi Tujuan',
            'kota_asal' => 'Kota Asal',
            'kota_tujuan' => 'Kota Tujuan',
            'jln' => 'Jln',
            'kurir' => 'Kurir',
            'kodepos' => 'Kodepos',
            'ongkir' => 'Ongkir',
            'berat' => 'Berat',
            'paid' => 'Paid',
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
    public function getDetailPesans()
    {
        return $this->hasMany(DetailPesan::className(), ['pesan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

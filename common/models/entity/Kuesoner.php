<?php

namespace common\models\entity;

use Yii;

/**
 * This is the model class for table "kuesoner".
 *
 * @property int $id
 * @property int $user_id
 * @property string $nama_responden
 * @property string $province_id
 * @property string $district_id
 * @property string $kecamatan
 * @property string $kelurahan
 * @property string $no_rt_terpilih
 * @property string $no_kk_terpilih
 * @property string $tgl_respon
 * @property int $jenis_kelamin
 * @property int $usia
 * @property int $kedudukan_dalam_keluarga
 * @property int $status_pernikahan
 * @property int $pendidikan_terakhir
 * @property int $pekerjaan
 * @property int $penghasilan_perbulan
 * @property int $3A_1
 * @property int $3A_2_1
 * @property int $3A_2_2
 * @property int $3A_2_3
 * @property int $3A_2_4
 * @property int $3A_3
 * @property int $3A_4
 * @property int $3A_5
 * @property int $3A_6
 * @property int $3A_7_1
 * @property int $3A_7_2
 * @property int $3A_8
 * @property int $3A_9_1
 * @property int $3A_9_2
 * @property int $3A_9_3
 * @property int $3A_10
 * @property int $3A_11_1
 * @property int $3A_11_2
 * @property int $3B_12
 * @property int $3B_13_1
 * @property int $3B_13_2
 * @property int $3B_13_3
 * @property int $3B_13_4
 * @property int $3B_14
 * @property int $3B_15
 * @property int $3B_16
 * @property int $3B_17
 * @property int $3B_18
 * @property int $3B_19
 * @property int $4A_20
 * @property int $4A_21
 * @property int $4A_22
 * @property int $4A_23
 * @property int $4A_24
 * @property int $4A_25
 * @property int $4A_26
 * @property int $4A_27
 * @property int $4B_28
 * @property int $4B_29
 * @property int $4B_30
 * @property int $4B_31
 * @property int $4B_32
 * @property int $4B_33
 * @property int $4B_34
 * @property int $4B_35
 * @property int $4B_36
 * @property int $4B_37
 * @property int $5A_38
 * @property int $5A_39
 * @property int $5A_40
 * @property int $5A_41
 * @property int $5A_42
 * @property int $5A_43
 * @property int $5A_44
 * @property int $5A_45
 * @property int $5A_46
 * @property int $5A_47
 * @property int $5A_48
 * @property int $5A_49
 * @property int $5A_50
 * @property int $5B_51
 * @property int $5B_52
 * @property int $5B_53
 * @property int $5B_54_1
 * @property int $5B_54_2
 * @property int $5B_55
 * @property int $5B_56_1
 * @property int $5B_56_2
 * @property int $5B_56_3
 *
 * @property User $user
 * @property Province $province
 * @property District $district
 */
class Kuesoner extends \yii\db\ActiveRecord
{
    
    const LAKI_LAKI     = 1;
    const PEREMPUAN     = 2;

    const USIA_18_19     = 1;
    const USIA_20_24     = 2;
    const USIA_25_29     = 3;
    const USIA_30_34     = 4;
    const USIA_35_39     = 5;
    const USIA_40_44     = 6;
    const USIA_45_49     = 7;
    const USIA_50_54     = 8;
    const USIA_55_59     = 9;
    const USIA_60        = 10;

    const AYAH          = 1;
    const IBU           = 2;
    const ANAK          = 3;

    const BELUM_MENIKAH     = 1;
    const MENIKAH           = 2;
    const CERAI_MATI        = 3;
    const CERAI_HIDUP       = 4;

    const SEKOLAH_BELUM_SEKOLAH     = 1;
    const SD                        = 2;
    const SMP                       = 3;
    const SMA                       = 4;
    const PT                        = 5;

    const BELUM_BEKERJA      = 1;
    const TIDAK_BEKERJA      = 2;
    const PETANI             = 3;
    const NELAYAN            = 4;
    const WIRASWASTA         = 5;
    const PNS                = 6;
    const PEGAWAI_SWASTA     = 7;
    const LAINNYA            = 8;

    const RP500      = 1;
    const RP1500     = 2;
    const RP2500     = 3;
    const RP3500     = 4;
    const RP4500     = 5;
    const RP5500     = 6;

    const SS         = 4;
    const S          = 3;
    const TS         = 2;
    const STS        = 1;

    const JR         = 2;
    const TP        = 1;

    public static function sTypes($index = 'all', $html = false)
    {
        $array = [
            self::SS         => 'Sangat Setuju',
            self::S          => 'Setuju',
            self::TS         => 'Tidak Setuju',
            self::STS        => 'Sangat Tidak Setuju',
        ];
        if (isset($array[$index])) return $array[$index];
        if ($index === 'all') return $array;
        return null;
    }

    public static function s2Types($index = 'all', $html = false)
    {
        $array = [
            self::SS         => 'Sangat Sering',
            self::S          => 'Sering',
            self::JR         => 'Jarang',
            self::TP        => 'Tidak Pernah',
        ];
        if (isset($array[$index])) return $array[$index];
        if ($index === 'all') return $array;
        return null;
    }

    public static function genderTypes($index = 'all', $html = false)
    {
        $array = [
            self::LAKI_LAKI       => 'Laki-Laki',
            self::PEREMPUAN       => 'Perempuan',
        ];
        if (isset($array[$index])) return $array[$index];
        if ($index === 'all') return $array;
        return null;
    }
    public function getGenderTypeText($html = false)
    {
        return self::genderTypes($this->jenis_kelamin, $html);
    }

    public static function usiaTypes($index = 'all', $html = false)
    {
        $array = [
            self::USIA_18_19     => '18-19 Tahun',
            self::USIA_20_24     => '20-24 Tahun',
            self::USIA_25_29     => '25-29 Tahun',
            self::USIA_30_34     => '30-34 Tahun',
            self::USIA_35_39     => '35-39 Tahun',
            self::USIA_40_44     => '40-44 Tahun',
            self::USIA_45_49     => '45-49 Tahun',
            self::USIA_50_54     => '50-54 Tahun',
            self::USIA_55_59     => '55-59 Tahun',
            // self::USIA_60        => '60+ Tahun'
        ];
        if (isset($array[$index])) return $array[$index];
        if ($index === 'all') return $array;
        return null;
    }
    public function getUsiaTypeText($html = false)
    {
        return self::usiaTypes($this->usia, $html);
    }
    public static function kkTypes($index = 'all', $html = false)
    {
        $array = [
            self::AYAH     => 'Ayah',
            self::IBU     => 'Ibu',
            self::ANAK     => 'Anak',
        ];
        if (isset($array[$index])) return $array[$index];
        if ($index === 'all') return $array;
        return null;
    }
    public function getKkTypeText($html = false)
    {
        return self::kkTypes($this->kedudukan_dalam_keluarga, $html);
    }
    public static function nikahTypes($index = 'all', $html = false)
    {
        $array = [
            self::BELUM_MENIKAH     => 'Belum Menikah',
            self::MENIKAH           => 'Nikah',
            self::CERAI_MATI        => 'Cerai Mati',
            self::CERAI_HIDUP       => 'Cerai Hidup',
        ];
        if (isset($array[$index])) return $array[$index];
        if ($index === 'all') return $array;
        return null;
    }
    public function getNikahTypeText($html = false)
    {
        return self::nikahTypes($this->status_pernikahan, $html);
    }
    public static function pendidikanTypes($index = 'all', $html = false)
    {
        $array = [
            self::SEKOLAH_BELUM_SEKOLAH     => 'Sekolah/ Belum sekolah ',
            self::SD                        => 'SD/MI sederajat ',
            self::SMP                       => 'SLTP/MTs sederajat ',
            self::SMA                       => 'SLTA / MA sederajat ',
            self::PT                        => 'Akademi/ Perguruan Tinggi ',
        ];
        if (isset($array[$index])) return $array[$index];
        if ($index === 'all') return $array;
        return null;
    }
    public function getPendidikanTypeText($html = false)
    {
        return self::pendidikanTypes($this->pendidikan_terakhir, $html);
    }
    public static function pekerjaanTypes($index = 'all', $html = false)
    {
        $array = [
            self::BELUM_BEKERJA      => 'Belum bekerja ',
            self::TIDAK_BEKERJA      => 'Tidak bekerja / IRT (ibu Rumah Tangga) ',
            self::PETANI             => 'Petani ',
            self::NELAYAN            => 'Nelayan ',
            self::WIRASWASTA         => 'Wiraswasta/ Pedagang',
            self::PNS                => 'PNS/TNI/Polri ',
            self::PEGAWAI_SWASTA     => 'Pegawai Swasta ',
            self::LAINNYA            => 'Lainnya',
        ];
        if (isset($array[$index])) return $array[$index];
        if ($index === 'all') return $array;
        return null;
    }
    public function getPekerjaanTypeText($html = false)
    {
        return self::pekerjaanTypes($this->pekerjaan, $html);
    }
    public static function penghasilanTypes($index = 'all', $html = false)
    {
        $array = [
            self::RP500      => 'Rp 500.000–Rp 1.500.000 ',
            self::RP1500     => 'Rp 1.500.000–Rp 2.500.000 ',
            self::RP2500     => 'Rp 2.500.000–Rp 3.500.000 ',
            self::RP3500     => 'Rp 3.500.000–Rp 4.500.000 ',
            self::RP4500     => 'Rp 4.500.000–Rp 5.500.000 ',
            self::RP5500     => '> Rp 5.500.000 ',

        ];
        if (isset($array[$index])) return $array[$index];
        if ($index === 'all') return $array;
        return null;
    }
    public function getPenghasilanTypeText($html = false)
    {
        return self::penghasilanTypes($this->penghasilan_perbulan, $html);
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kuesoner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['user_id', 'nama_responden','province_id', 'district_id', 'kecamatan', 'kelurahan','no_rt_terpilih','no_kk_terpilih','tgl_respon', 'jenis_kelamin', 'usia', 'kedudukan_dalam_keluarga', 'status_pernikahan', 'pendidikan_terakhir', 'pekerjaan', 'penghasilan_perbulan', '3A_1', '3A_2_1', '3A_2_2', '3A_2_3', '3A_2_4', '3A_3', '3A_4', '3A_5', '3A_6', '3A_7_1', '3A_7_2', '3A_8', '3A_9_1', '3A_9_2', '3A_9_3', '3A_10', '3A_11_1', '3A_11_2', '3B_12', '3B_13_1', '3B_13_2', '3B_13_3', '3B_13_4', '3B_14', '3B_15', '3B_16', '3B_17', '3B_18', '3B_19', '4A_20', '4A_21', '4A_22', '4A_23', '4A_24', '4A_25', '4A_26', '4A_27', '4B_28', '4B_29', '4B_30', '4B_31', '4B_32', '4B_33', '4B_34', '4B_35', '4B_36', '4B_37', '5A_38', '5A_39', '5A_40', '5A_41', '5A_42', '5A_43', '5A_44', '5A_45', '5A_46', '5A_47', '5A_48', '5A_49', '5A_50', '5B_51', '5B_52', '5B_53', '5B_54_1', '5B_54_2', '5B_55', '5B_56_1', '5B_56_2', '5B_56_3'], 'required'],
            [['user_id', 'jenis_kelamin', 'usia', 'kedudukan_dalam_keluarga', 'status_pernikahan', 'pendidikan_terakhir', 'pekerjaan','no_rt_terpilih','no_kk_terpilih', 'penghasilan_perbulan', '3A_1', '3A_2_1', '3A_2_2', '3A_2_3', '3A_2_4', '3A_3', '3A_4', '3A_5', '3A_6', '3A_7_1', '3A_7_2', '3A_8', '3A_9_1', '3A_9_2', '3A_9_3', '3A_10', '3A_11_1', '3A_11_2', '3B_12', '3B_13_1', '3B_13_2', '3B_13_3', '3B_13_4', '3B_14', '3B_15', '3B_16', '3B_17', '3B_18', '3B_19', '4A_20', '4A_21', '4A_22', '4A_23', '4A_24', '4A_25', '4A_26', '4A_27', '4B_28', '4B_29', '4B_30', '4B_31', '4B_32', '4B_33', '4B_34', '4B_35', '4B_36', '4B_37', '5A_38', '5A_39', '5A_40', '5A_41', '5A_42', '5A_43', '5A_44', '5A_45', '5A_46', '5A_47', '5A_48', '5A_49', '5A_50', '5B_51', '5B_52', '5B_53', '5B_54_1', '5B_54_2', '5B_55', '5B_56_1', '5B_56_2', '5B_56_3'], 'integer'],
            [['tgl_respon','nama_responden'], 'safe'],
            [['province_id'], 'string', 'max' => 2],
            [['district_id'], 'string', 'max' => 4],
            [['kecamatan', 'kelurahan'], 'string', 'max' => 191],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['province_id' => 'id']],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['district_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            // 'id' => 'ID',
            'user_id' => 'User ID',
            'nama_responden'=>'Nama Responden',
            'province_id' => 'Provinsi',
            'district_id' => 'Kabupaten/Kota',
            'kecamatan' => 'Kecamatan',
            'kelurahan' => 'Kelurahan',
            'no_rt_terpilih' => 'Nomor RT Terpilih',
            'no_kk_terpilih' => 'Nomor Keluarga Terpilih',
            'tgl_respon' => 'Tgl Respon',
            'jenis_kelamin' => 'Jenis Kelamin',
            'usia' => 'Usia',
            'kedudukan_dalam_keluarga' => 'Kedudukan Dalam Keluarga',
            'status_pernikahan' => 'Status Pernikahan',
            'pendidikan_terakhir' => 'Pendidikan Terakhir',
            'pekerjaan' => 'Pekerjaan',
            'penghasilan_perbulan' => 'Penghasilan Perbulan',
            '3A_1' => '3 A 1',
            '3A_2_1' => '3 A 2 1',
            '3A_2_2' => '3 A 2 2',
            '3A_2_3' => '3 A 2 3',
            '3A_2_4' => '3 A 2 4',
            '3A_3' => '3 A 3',
            '3A_4' => '3 A 4',
            '3A_5' => '3 A 5',
            '3A_6' => '3 A 6',
            '3A_7_1' => '3 A 7 1',
            '3A_7_2' => '3 A 7 2',
            '3A_8' => '3 A 8',
            '3A_9_1' => '3 A 9 1',
            '3A_9_2' => '3 A 9 2',
            '3A_9_3' => '3 A 9 3',
            '3A_10' => '3 A 10',
            '3A_11_1' => '3 A 11 1',
            '3A_11_2' => '3 A 11 2',
            '3B_12' => '3 B 12',
            '3B_13_1' => '3 B 13 1',
            '3B_13_2' => '3 B 13 2',
            '3B_13_3' => '3 B 13 3',
            '3B_13_4' => '3 B 13 4',
            '3B_14' => '3 B 14',
            '3B_15' => '3 B 15',
            '3B_16' => '3 B 16',
            '3B_17' => '3 B 17',
            '3B_18' => '3 B 18',
            '3B_19' => '3 B 19',
            '4A_20' => '4 A 20',
            '4A_21' => '4 A 21',
            '4A_22' => '4 A 22',
            '4A_23' => '4 A 23',
            '4A_24' => '4 A 24',
            '4A_25' => '4 A 25',
            '4A_26' => '4 A 26',
            '4A_27' => '4 A 27',
            '4B_28' => '4 B 28',
            '4B_29' => '4 B 29',
            '4B_30' => '4 B 30',
            '4B_31' => '4 B 31',
            '4B_32' => '4 B 32',
            '4B_33' => '4 B 33',
            '4B_34' => '4 B 34',
            '4B_35' => '4 B 35',
            '4B_36' => '4 B 36',
            '4B_37' => '4 B 37',
            '5A_38' => '5 A 38',
            '5A_39' => '5 A 39',
            '5A_40' => '5 A 40',
            '5A_41' => '5 A 41',
            '5A_42' => '5 A 42',
            '5A_43' => '5 A 43',
            '5A_44' => '5 A 44',
            '5A_45' => '5 A 45',
            '5A_46' => '5 A 46',
            '5A_47' => '5 A 47',
            '5A_48' => '5 A 48',
            '5A_49' => '5 A 49',
            '5A_50' => '5 A 50',
            '5B_51' => '5 B 51',
            '5B_52' => '5 B 52',
            '5B_53' => '5 B 53',
            '5B_54_1' => '5 B 54 1',
            '5B_54_2' => '5 B 54 2',
            '5B_55' => '5 B 55',
            '5B_56_1' => '5 B 56 1',
            '5B_56_2' => '5 B 56 2',
            '5B_56_3' => '5 B 56 3',
        ];
    }

    public function Attfield()
    {
        return [
            // 'id' ,
            'user_id' ,
            'nama_responden',
            'province_id' ,
            'district_id' ,
            'kecamatan' ,
            'kelurahan' ,
            'no_rt_terpilih' ,
            'no_kk_terpilih' ,
            'tgl_respon' ,
            'jenis_kelamin' ,
            'usia' ,
            'kedudukan_dalam_keluarga' ,
            'status_pernikahan' ,
            'pendidikan_terakhir' ,
            'pekerjaan' ,
            'penghasilan_perbulan' ,
            '3A_1' ,
            '3A_2_1' ,
            '3A_2_2' ,
            '3A_2_3' ,
            '3A_2_4' ,
            '3A_3' ,
            '3A_4' ,
            '3A_5' ,
            '3A_6' ,
            '3A_7_1' ,
            '3A_7_2' ,
            '3A_8' ,
            '3A_9_1' ,
            '3A_9_2' ,
            '3A_9_3' ,
            '3A_10' ,
            '3A_11_1' ,
            '3A_11_2' ,
            '3B_12' ,
            '3B_13_1' ,
            '3B_13_2' ,
            '3B_13_3' ,
            '3B_13_4' ,
            '3B_14' ,
            '3B_15' ,
            '3B_16' ,
            '3B_17' ,
            '3B_18' ,
            '3B_19' ,
            '4A_20' ,
            '4A_21' ,
            '4A_22' ,
            '4A_23' ,
            '4A_24' ,
            '4A_25' ,
            '4A_26' ,
            '4A_27' ,
            '4B_28' ,
            '4B_29' ,
            '4B_30' ,
            '4B_31' ,
            '4B_32' ,
            '4B_33' ,
            '4B_34' ,
            '4B_35' ,
            '4B_36' ,
            '4B_37' ,
            '5A_38' ,
            '5A_39' ,
            '5A_40' ,
            '5A_41' ,
            '5A_42' ,
            '5A_43' ,
            '5A_44' ,
            '5A_45' ,
            '5A_46' ,
            '5A_47' ,
            '5A_48' ,
            '5A_49' ,
            '5A_50' ,
            '5B_51' ,
            '5B_52' ,
            '5B_53' ,
            '5B_54_1' ,
            '5B_54_2' ,
            '5B_55' ,
            '5B_56_1' ,
            '5B_56_2' ,
            '5B_56_3' ,
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Province]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['id' => 'province_id']);
    }

    /**
     * Gets query for [[District]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'district_id']);
    }
    public static function getPersentase($field, $kondisi)
    {
        $allData = Kuesoner::find()->count();
        $model = Kuesoner::find()->where([$field => $kondisi])->count();

        if ($allData != null && $model != null) {
            $persentse = ($model / $allData) * (100);
        } else {
            $persentse = 0;
        }
        return $persentse;
    }
    public static function getCountDistrict($field)
    {
        $allData = District::find()->count();
        $model = Kuesoner::find()->groupBy($field)->count();
        if ($allData != null && $model != null) {
            $persentse = ($model / $allData) * (100);
        } else {
            $persentse = 0;
        }
        return $persentse;
    }
    public static function getCountData($field, $kondisi)
    {
        $model = Kuesoner::find()->where([$field => $kondisi])->count();
        return $model;
    }
}

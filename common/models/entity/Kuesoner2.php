<?php

namespace common\models\entity;

use Yii;

/**
 * This is the model class for table "kuesoner2".
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
 * @property int $3A_5_1
 * @property int $3A_5_2
 * @property int $3A_6_1
 * @property int $3A_6_2
 * @property int $3A_7
 * @property int $3A_8_1
 * @property int $3A_8_2
 * @property int $3B_9
 * @property int $3B_10_1
 * @property int $3B_10_2
 * @property int $3B_10_3
 * @property int $3B_10_4
 * @property int $3B_11
 * @property int $3B_12
 * @property int $3B_13
 * @property int $4A_14
 * @property int $4A_15
 * @property int $4A_16
 * @property int $4A_17
 * @property int $4A_18
 * @property int $4A_19
 * @property int $4A_20
 * @property int $4A_21
 * @property int $4B_22
 * @property int $4B_23
 * @property int $4B_24
 * @property int $4B_25
 * @property int $4B_26
 * @property int $4B_27
 * @property int $4B_28
 * @property int $5A_29
 * @property int $5A_30
 * @property int $5A_31
 * @property int $5A_32
 * @property int $5A_33
 * @property int $5A_34
 * @property int $5A_35
 * @property int $5A_36
 * @property int $5A_37
 * @property int $5A_38
 * @property int $5B_39
 * @property int $5B_40
 * @property int $5B_41
 * @property int $5B_42_1
 * @property int $5B_42_2
 * @property int $5B_43
 * @property int $5B_44_1
 * @property int $5B_45_2
 * @property int $5B_46_3
 *
 * @property User $user
 * @property Province $province
 * @property District $district
 */
class Kuesoner2 extends \yii\db\ActiveRecord
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
        return 'kuesoner2';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'nama_responden', 'province_id', 'district_id', 'kecamatan', 'kelurahan', 'no_rt_terpilih', 'no_kk_terpilih', 'tgl_respon', 'jenis_kelamin', 'usia', 'kedudukan_dalam_keluarga', 'status_pernikahan', 'pendidikan_terakhir', 'pekerjaan', 'penghasilan_perbulan', '3A_1', '3A_2_1', '3A_2_2', '3A_2_3', '3A_2_4', '3A_3', '3A_4', '3A_5_1', '3A_5_2', '3A_6_1', '3A_6_2', '3A_7', '3A_8_1', '3A_8_2', '3B_9', '3B_10_1', '3B_10_2', '3B_10_3', '3B_10_4', '3B_11', '3B_12', '3B_13', '4A_14', '4A_15', '4A_16', '4A_17', '4A_18', '4A_19', '4A_20', '4A_21', '4B_22', '4B_23', '4B_24', '4B_25', '4B_26', '4B_27', '4B_28', '5A_29', '5A_30', '5A_31', '5A_32', '5A_33', '5A_34', '5A_35', '5A_36', '5A_37', '5A_38', '5B_39', '5B_40', '5B_41', '5B_42_1', '5B_42_2', '5B_43', '5B_44_1', '5B_44_2', '5B_44_3'], 'required'],
            [['user_id', 'jenis_kelamin', 'usia', 'kedudukan_dalam_keluarga', 'status_pernikahan', 'pendidikan_terakhir', 'pekerjaan', 'penghasilan_perbulan', '3A_1', '3A_2_1', '3A_2_2', '3A_2_3', '3A_2_4', '3A_3', '3A_4', '3A_5_1', '3A_5_2', '3A_6_1', '3A_6_2', '3A_7', '3A_8_1', '3A_8_2', '3B_9', '3B_10_1', '3B_10_2', '3B_10_3', '3B_10_4', '3B_11', '3B_12', '3B_13', '4A_14', '4A_15', '4A_16', '4A_17', '4A_18', '4A_19', '4A_20', '4A_21', '4B_22', '4B_23', '4B_24', '4B_25', '4B_26', '4B_27', '4B_28', '5A_29', '5A_30', '5A_31', '5A_32', '5A_33', '5A_34', '5A_35', '5A_36', '5A_37', '5A_38', '5B_39', '5B_40', '5B_41', '5B_42_1', '5B_42_2', '5B_43', '5B_44_1', '5B_44_2', '5B_44_3'], 'integer'],
            [['tgl_respon'], 'safe'],
            [['nama_responden', 'kecamatan', 'kelurahan', 'no_rt_terpilih', 'no_kk_terpilih'], 'string', 'max' => 191],
            [['province_id'], 'string', 'max' => 2],
            [['district_id'], 'string', 'max' => 4],
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
            'id' => 'ID',
            'user_id' => 'User ID',
            'nama_responden' => 'Nama Responden',
            'province_id' => 'Provinsi ',
            'district_id' => 'Kabupaten/Kota',
            'kecamatan' => 'Kecamatan',
            'kelurahan' => 'Kelurahan',
            'no_rt_terpilih' => 'No Rt Terpilih',
            'no_kk_terpilih' => 'No Kk Terpilih',
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
            '3A_5_1' => '3 A 5 1',
            '3A_5_2' => '3 A 5 2',
            '3A_6_1' => '3 A 6 1',
            '3A_6_2' => '3 A 6 2',
            '3A_7' => '3 A 7',
            '3A_8_1' => '3 A 8 1',
            '3A_8_2' => '3 A 8 2',
            '3B_9' => '3 B 9',
            '3B_10_1' => '3 B 10 1',
            '3B_10_2' => '3 B 10 2',
            '3B_10_3' => '3 B 10 3',
            '3B_10_4' => '3 B 10 4',
            '3B_11' => '3 B 11',
            '3B_12' => '3 B 12',
            '3B_13' => '3 B 13',
            '4A_14' => '4 A 14',
            '4A_15' => '4 A 15',
            '4A_16' => '4 A 16',
            '4A_17' => '4 A 17',
            '4A_18' => '4 A 18',
            '4A_19' => '4 A 19',
            '4A_20' => '4 A 20',
            '4A_21' => '4 A 21',
            '4B_22' => '4 B 22',
            '4B_23' => '4 B 23',
            '4B_24' => '4 B 24',
            '4B_25' => '4 B 25',
            '4B_26' => '4 B 26',
            '4B_27' => '4 B 27',
            '4B_28' => '4 B 28',
            '5A_29' => '5 A 29',
            '5A_30' => '5 A 30',
            '5A_31' => '5 A 31',
            '5A_32' => '5 A 32',
            '5A_33' => '5 A 33',
            '5A_34' => '5 A 34',
            '5A_35' => '5 A 35',
            '5A_36' => '5 A 36',
            '5A_37' => '5 A 37',
            '5A_38' => '5 A 38',
            '5B_39' => '5 B 39',
            '5B_40' => '5 B 40',
            '5B_41' => '5 B 41',
            '5B_42_1' => '5 B 42 1',
            '5B_42_2' => '5 B 42 2',
            '5B_43' => '5 B 43',
            '5B_44_1' => '5 B 44 1',
            '5B_44_2' => '5 B 44 2',
            '5B_44_3' => '5 B 44 3',
        ];
    }
    public function Attfield()
    {
        return [
            'user_id',
            'nama_responden',
            'province_id',
            'district_id',
            'kecamatan',
            'kelurahan',
            'no_rt_terpilih',
            'no_kk_terpilih',
            'tgl_respon',
            'jenis_kelamin',
            'usia',
            'kedudukan_dalam_keluarga',
            'status_pernikahan',
            'pendidikan_terakhir',
            'pekerjaan',
            'penghasilan_perbulan',
            '3A_1',
            '3A_2_1',
            '3A_2_2',
            '3A_2_3',
            '3A_2_4',
            '3A_3',
            '3A_4',
            '3A_5_1',
            '3A_5_2',
            '3A_6_1',
            '3A_6_2',
            '3A_7',
            '3A_8_1',
            '3A_8_2',
            '3B_9',
            '3B_10_1',
            '3B_10_2',
            '3B_10_3',
            '3B_10_4',
            '3B_11',
            '3B_12',
            '3B_13',
            '4A_14',
            '4A_15',
            '4A_16',
            '4A_17',
            '4A_18',
            '4A_19',
            '4A_20',
            '4A_21',
            '4B_22',
            '4B_23',
            '4B_24',
            '4B_25',
            '4B_26',
            '4B_27',
            '4B_28',
            '5A_29',
            '5A_30',
            '5A_31',
            '5A_32',
            '5A_33',
            '5A_34',
            '5A_35',
            '5A_36',
            '5A_37',
            '5A_38',
            '5B_39',
            '5B_40',
            '5B_41',
            '5B_42_1',
            '5B_42_2',
            '5B_43',
            '5B_44_1',
            '5B_44_2',
            '5B_44_3',
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
        $model = Kuesoner2::find()->where([$field => $kondisi])->count();

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
        $model = Kuesoner2::find()->groupBy($field)->count();
        if ($allData != null && $model != null) {
            $persentse = ($model / $allData) * (100);
        } else {
            $persentse = 0;
        }
        return $persentse;
    }
    public static function getCountData($field, $kondisi)
    {
        $model = Kuesoner2::find()->where([$field => $kondisi])->count();
        return $model;
    }
}

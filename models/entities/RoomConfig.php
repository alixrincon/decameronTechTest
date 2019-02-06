<?php

namespace app\models\entities;

use Yii;

/**
 * This is the model class for table "roomConfig".
 *
 * @property int $id
 * @property int $accomodationtype
 * @property int $hotelroomtype
 *
 * @property HotelHasRooms[] $hotelHasRooms
 * @property Accomodation $accomodationtype0
 * @property HotelRoomType $hotelroomtype0
 */
class RoomConfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'roomConfig';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['accomodationtype', 'hotelroomtype'], 'default', 'value' => null],
            [['accomodationtype', 'hotelroomtype'], 'integer'],
            [['accomodationtype'], 'unique'],
            [['hotelroomtype'], 'unique'],
            [['accomodationtype'], 'exist', 'skipOnError' => true, 'targetClass' => Accomodation::className(), 'targetAttribute' => ['accomodationtype' => 'id']],
            [['hotelroomtype'], 'exist', 'skipOnError' => true, 'targetClass' => HotelRoomType::className(), 'targetAttribute' => ['hotelroomtype' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'accomodationtype' => 'Accomodationtype',
            'hotelroomtype' => 'Hotelroomtype',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelHasRooms()
    {
        return $this->hasMany(HotelHasRooms::className(), ['idroomconfig' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccomodationtype0()
    {
        return $this->hasOne(Accomodation::className(), ['id' => 'accomodationtype']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelroomtype0()
    {
        return $this->hasOne(HotelRoomType::className(), ['id' => 'hotelroomtype']);
    }
}

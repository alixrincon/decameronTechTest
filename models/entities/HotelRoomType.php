<?php

namespace app\models\entities;

use Yii;

/**
 * This is the model class for table "hotelRoomType".
 *
 * @property int $id
 * @property string $name descripcion tipo de habitacion
 *
 * @property RoomConfig $roomConfig
 */
class HotelRoomType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotelRoomType';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomConfig()
    {
        return $this->hasOne(RoomConfig::className(), ['hotelroomtype' => 'id']);
    }
}

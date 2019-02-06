<?php

namespace app\models\entities;

use Yii;

/**
 * This is the model class for table "accomodation".
 *
 * @property int $id
 * @property string $name
 *
 * @property RoomConfig $roomConfig
 */
class Accomodation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accomodation';
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
        return $this->hasOne(RoomConfig::className(), ['accomodationtype' => 'id']);
    }
}

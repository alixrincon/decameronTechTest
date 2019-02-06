<?php

namespace app\models\entities;

use Yii;

/**
 * This is the model class for table "hotelHasRooms".
 *
 * @property int $id
 * @property int $idhotel
 * @property int $idroomconfig
 * @property int $amount
 *
 * @property Hotel $hotel
 * @property RoomConfig $roomconfig
 */
class HotelHasRooms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotelHasRooms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idhotel', 'idroomconfig', 'amount'], 'required'],
            [['idhotel', 'idroomconfig', 'amount'], 'default', 'value' => null],
            [['idhotel', 'idroomconfig', 'amount'], 'integer'],
            [['idhotel'], 'exist', 'skipOnError' => true, 'targetClass' => Hotel::className(), 'targetAttribute' => ['idhotel' => 'id']],
            [['idroomconfig'], 'exist', 'skipOnError' => true, 'targetClass' => RoomConfig::className(), 'targetAttribute' => ['idroomconfig' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idhotel' => 'hotel',
            'idroomconfig' => 'Tipo Acomodación',
            'amount' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotel()
    {
        return $this->hasOne(Hotel::className(), ['id' => 'idhotel']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomconfig()
    {
        return $this->hasOne(RoomConfig::className(), ['id' => 'idroomconfig']);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $model = HotelHasRooms::find()
            ->where('idhotel = :id',[':id' => $this->idhotel])
            ->all();

        $maxrooms = Hotel::findOne($this->idhotel)->total_rooms;

        $acum = 0;
        if(count($model) > 0){
            foreach ($model as $value) {
                $acum += $value->amount;
                if($this->idhotel == $value->idhotel && $this->idroomconfig == $value->idroomconfig){
                    $this->addError("idhotel", 'Ya tiene acomodaciones registradas en este hotel, para este tipo de acomodación');
                    return false;
                }
            }
        }

        if(($acum + $this->amount) > $maxrooms){
            $this->addError("amount", 'Tiene disponible ' . ($maxrooms - $acum) . ' habitaciones para acomodar en este hotel');
            return false;
        }
        else{
            return true;
        }
    }
}

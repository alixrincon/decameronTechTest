<?php

namespace app\models\entities;

use Yii;

/**
 * This is the model class for table "hotel".
 *
 * @property int $id
 * @property string $name nombre del hotel
 * @property string $nit nit del hotel
 * @property string $address direccion
 * @property string $idcity nombre ciudad
 * @property int $total_rooms
 */
class Hotel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'nit', 'total_rooms', 'idcity'], 'required'],
            [['name', 'nit', 'address'], 'string'],
            [['total_rooms'], 'default', 'value' => null],
            [['total_rooms'], 'integer'],
            [['idcity'], 'string', 'max' => 255],
            [['nit'], 'string', 'max' => 10],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nombre',
            'nit' => 'Nit',
            'address' => 'Dirección',
            'idcity' => 'Ciudad',
            'total_rooms' => 'Total Habitaciones',
        ];
    }
}

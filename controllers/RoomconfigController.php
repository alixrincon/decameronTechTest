<?php
/**
 * Created by PhpStorm.
 * User: Alix Rincon
 * Date: 05/02/2019
 * Time: 11:40
 */

namespace app\controllers;


use app\models\entities\RoomConfig;

class RoomconfigController extends BaseController
{
    public $modelClass = 'app\models\entities\RoomConfig';


    public function actions()
    {
        $actions = parent::actions();
        return $actions;
    }

    //Metodo que trae por el id del tipo de habitacion el tipo de acomodacion.
    public function actionGetbyid($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //Se define la respuesta en JSON
        //Busqueda en el modelo de RoomConfig por el id del tipo de habitacion.
        $model = RoomConfig::find()
            ->select(['roomconfig.*'])
            ->innerJoinWith('accomodationtype0', 'accomodationtype0.id = t.accomodationtype')
            ->where(['hotelroomtype' => $id])
            ->all();
        //Se recorre el modelo y se asigna en el id del la tabla roomConfig y el name para el select de tipo acomodacion
        foreach($model as $key => $value){
            $response[] =
                [
                    "Id" => $value->id,
                    "accomodationtypeName" => $value->accomodationtype0->name];
        }

        return $response;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Alix Rincón
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

    public function actionGetbyid($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = RoomConfig::find()
            ->select(['roomConfig.*'])
            ->innerJoinWith('accomodationtype0', 'accomodationtype0.id = t.accomodationtype')
            ->where(['hotelroomtype' => $id])
            ->all();

        foreach($model as $key => $value){
            $response[] =
                [
                    "Id" => $value->id,
                    "accomodationtypeName" => $value->accomodationtype0->name];
        }

        return $response;
    }

}
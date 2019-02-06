<?php
/**
 * Created by PhpStorm.
 * User: Alix Rincón
 * Date: 05/02/2019
 * Time: 19:47
 */

namespace app\controllers;


class HotelhasroomsController extends BaseController
{
    public $modelClass = 'app\models\entities\HotelHasRooms';


    public function actions()
    {
        $actions = parent::actions();
        return $actions;
    }



}
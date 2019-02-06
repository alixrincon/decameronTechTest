<?php
/**
 * Created by PhpStorm.
 * User: Alix Rincon
 * Date: 05/02/2019
 * Time: 11:44
 */

namespace app\controllers;


class HotelroomtypeController extends BaseController
{
    public $modelClass = 'app\models\entities\HotelRoomType';

    public function actions()
    {
        $actions = parent::actions();
        return $actions;
    }

}
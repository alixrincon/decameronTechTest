<?php

namespace app\controllers;


class HotelController extends BaseController
{
    public $modelClass = 'app\models\entities\Hotel';


    public function actions()
    {
        $actions = parent::actions();

        return $actions;
    }


}

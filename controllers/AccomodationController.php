<?php
/**
 * Created by PhpStorm.
 * User: Alix Rincon
 * Date: 05/02/2019
 * Time: 11:54
 */

namespace app\controllers;


class AccomodationController extends BaseController
{
    public $modelClass = 'app\models\entities\Accomodation';

    public function actions()
    {
        $actions = parent::actions();
        return $actions;
    }

}
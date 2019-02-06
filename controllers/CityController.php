<?php
/**
 * Created by PhpStorm.
 * User: Alix Rincon
 * Date: 05/02/2019
 * Time: 9:53
 */

namespace app\controllers;


class CityController extends BaseController
{

    public $modelClass = 'app\models\entities\City';

    public function actions()
    {
        $actions = parent::actions();

        // disable the "delete" and "create" actions
        /*unset($actions['delete'], $actions['create']);

        // customize the data provider preparation with the "prepareDataProvider()" method
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];*/

        return $actions;
    }
}
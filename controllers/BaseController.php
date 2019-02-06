<?php
/**
 * Created by PhpStorm.
 * User: Alix Rincon
 * Date: 04/02/2019
 * Time: 16:48
 */

namespace app\controllers;

use yii\rest\ActiveController;

class BaseController extends ActiveController
{
    public static function allowedDomains() {
        return [
            //'*',                        // star allows all domains
             'http://localhost',
             'http://127.0.0.1',
             'http://alixhotelsdecame.byethost3.com/',
        ];
    }
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return array_merge(parent::behaviors(), [

            // For cross-domain AJAX request
            'corsFilter'  => [
                'class' => \yii\filters\Cors::className(),
                'cors'  => [
                    // restrict access to domains:
                    'Origin'                           => static::allowedDomains(),
                    'Access-Control-Request-Method'    => ['POST'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Allow-Origin' => false,
                    'Access-Control-Max-Age'           => 3600,                 // Cache (seconds)
                ],
            ],

        ]);
    }



}
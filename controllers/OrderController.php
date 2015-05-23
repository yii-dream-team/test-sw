<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace app\controllers;

use yii\web\Controller;

class OrderController extends Controller
{
    public function actionAdd()
    {
        return $this->render('add');
    }

    public function actionEdit($orderId)
    {
        return $this->render('edit');
    }
}
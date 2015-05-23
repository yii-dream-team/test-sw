<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace app\controllers;

use app\models\OrderItem;
use yii\base\Model;
use yii\web\Controller;

class OrderController extends Controller
{
    public function actionAdd()
    {
        $count = count(\Yii::$app->request->post('OrderItem', []));
        $items = [new OrderItem()];
        for($i = 1; $i < $count; $i++) {
            $items[] = new OrderItem();
        }

        if(Model::loadMultiple($items, \Yii::$app->request->post()) && Model::validateMultiple($items)) {
            exit;
        }

        return $this->render('add', [
            'models' => $items
        ]);
    }

    public function actionEdit($orderId)
    {
        return $this->render('edit');
    }
}
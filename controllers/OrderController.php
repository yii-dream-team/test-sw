<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace app\controllers;

use app\models\OrderItem;
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

        if(OrderItem::loadMultiple($items, \Yii::$app->request->post()) && OrderItem::validateMultiple($items)) {
            exit;
        }

        return $this->render('add', [
            'models' => $items
        ]);
    }

    public function actionEdit($id)
    {
        $orderId = intval($id);

        $models = $this->loadItems($orderId);

        if (OrderItem::loadMultiple($models, \Yii::$app->request->post()) &&
            OrderItem::validateMultiple($models)) {
            $count = 0;
            foreach ($models as $item) {
                if ($item->isDeleted)
                    $item->delete();
                else {
                    if ($item->save()) {
                        $count++;
                    }
                }
            }
            \Yii::$app->session->setFlash('success', "Processed {$count} records successfully.");
            return $this->redirect(['edit', 'id' => $orderId]);
        } else {
            return $this->render('edit', [
                'models' => $models,
                'orderId' => $orderId,
            ]);
        }
    }

    /**
     * @param int $orderId
     * @return OrderItem[]
     */
    protected function loadItems($orderId)
    {
        return OrderItem::find()->where(['order_id' => $orderId])->orderBy('id')->all();
    }
}
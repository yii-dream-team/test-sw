<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace app\controllers;

use app\models\OrderItem;
use yii\base\Model;
use yii\db\Exception;
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
            $orderId = OrderItem::generateOrderId();

            $dbTransaction = \Yii::$app->db->beginTransaction();
            try {
                foreach($items as $item) {
                    /** @var OrderItem $item */
                    $item->order_id = $orderId;
                    $item->save(false);
                }
                $dbTransaction->commit();
            } catch(Exception $e) {
                $dbTransaction->rollback();
                throw $e;
            }

            \Yii::$app->session->setFlash('success', "Order with ID {$orderId} successfully created!");
            return $this->redirect(['edit', 'orderId' => $orderId]);
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
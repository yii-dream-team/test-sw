<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace app\controllers;

use app\models\OrderItem;
use yii\db\Exception;
use yii\web\Controller;

class OrderController extends Controller
{
    public function actionAdd()
    {
        $count = $this->getPostedItemsCount();

        $items = [new OrderItem()];
        for($i = 1; $i < $count; $i++) {
            $items[] = new OrderItem();
        }

        if(OrderItem::loadMultiple($items, \Yii::$app->request->post()) && OrderItem::validateMultiple($items)) {
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
            return $this->redirect(['edit', 'id' => $orderId]);
        }

        return $this->render('add', [
            'models' => $items
        ]);
    }

    public function actionEdit($id)
    {
        $orderId = intval($id);

        $models = $this->loadItems($orderId);

        for ($i = count($models) + 1; $i <= $this->getPostedItemsCount(); $i++) {
            $models[] =  new OrderItem([
                'order_id' => $orderId,
            ]);
        }

        if (OrderItem::loadMultiple($models, \Yii::$app->request->post()) &&
            OrderItem::validateMultiple($models)) {
            $count = 0;
            foreach ($models as $item) {
                if (!$item->isNewRecord && $item->isDeleted)
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

    /**
     * @return int
     */
    protected function getPostedItemsCount()
    {
        return count(\Yii::$app->request->post('OrderItem', []));
    }
}
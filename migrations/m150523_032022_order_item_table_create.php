<?php

use yii\db\Schema;
use yii\db\Migration;

class m150523_032022_order_item_table_create extends Migration
{
    public function up()
    {
        $this->createTable('{{%order_item}}', [
            'id' => Schema::TYPE_PK,
            'order_id' => Schema::TYPE_INTEGER. ' NOT NULL',
            'price' => Schema::TYPE_MONEY . ' DEFAULT 0',
            'description' => Schema::TYPE_STRING,
            'available' => Schema::TYPE_BOOLEAN . ' NOT NULL DEFAULT 0'
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%order_item}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `notify_history`.
 */
class m171019_111303_create_notify_history_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('notifier_history', [
            'id' => $this->primaryKey(),
            'template_id' => $this->integer()->notNull(),
            'data' => $this->text()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('notify_history');
    }
}

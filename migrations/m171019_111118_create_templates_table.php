<?php

use yii\db\Migration;

/**
 * Handles the creation of table `templates`.
 */
class m171019_111118_create_templates_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('notifier_templates', [
            'id' => $this->primaryKey(),
            'label' => $this->string()->notNull(),
            'message' => $this->text()->notNull(),
            'type_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createTable('notifier_senders',[
            'id' => $this->primaryKey(),
            'label' => $this->string()->notNull(),
            'class' => $this->string(255)->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }



    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('templates');
    }
}

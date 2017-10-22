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
        $this->createTable('templates', [
            'id' => $this->primaryKey(),
            'label' => $this->string()->notNull(),
            'message' => $this->text()->notNull(),
            'type_id' => $this->integer()->notNull(),
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

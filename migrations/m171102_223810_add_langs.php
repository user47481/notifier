<?php

use yii\db\Migration;

class m171102_223810_add_langs extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%notifier_templates_lang}}',[
            'id'=>$this->primaryKey(),
            'notifier_templates_id'=>$this->integer()->notNull(),
            'language'=>$this->string(6)->notNull(),
            'label'=>$this->string()->notNull(),
            'message'=> $this->string()->notNull()
        ]);

        $this->addForeignKey('notifier_templates_lang','{{%notifier_templates_lang}}','notifier_templates_id','{{%notifier_templates}}','id','CASCADE','CASCADE');

    }

    public function safeDown()
    {
        echo "m171102_223810_add_langs cannot be reverted.\n";

        return false;
    }
}

<?php

use yii\db\Migration;

/**
 * Class m201112_051722_create_table_message
 */
class m201112_051722_create_table_message extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('message', [
            'id' => $this->primaryKey()->unsigned(),
            'from_user_id' => $this->integer()->unsigned()->notNull(),
            'to_user_id' => $this->integer()->unsigned()->notNull(),
            'trip_id' => $this->integer()->unsigned()->notNull(),
            'text' => $this->text()->notNull(),
            'created' => $this->timestamp()->notNull()->defaultExpression('NOW()')
        ]);

        $this->createIndex('idx_message_from_user_id_user', 'message', 'from_user_id');
        $this->addForeignKey('fk_message_from_user_id_user', 'message', 'from_user_id', 'user', 'id', 'restrict', 'cascade');

        $this->createIndex('idx_message_to_user_id_user', 'message', 'to_user_id');
        $this->addForeignKey('fk_message_to_user_id_user', 'message', 'to_user_id', 'user', 'id', 'restrict', 'cascade');

        $this->createIndex('idx_message_trip_id_trip', 'message', 'trip_id');
        $this->addForeignKey('fk_message_trip_id_trip', 'message', 'trip_id', 'trip', 'id', 'restrict', 'cascade');
    
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201112_051722_create_table_message cannot be reverted.\n";
        $this->dropForeignKey('fk_message_from_user_id_user', 'message');
        $this->dropIndex('idx_message_from_user_id_user', 'message');

        $this->dropForeignKey('fk_message_to_user_id_user', 'message');
        $this->dropIndex('idx_message_to_user_id_user', 'message');

        $this->dropForeignKey('fk_message_trip_id_trip', 'message');
        $this->dropIndex('idx_message_trip_id_trip', 'message');

        $this->dropTable('message');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201112_051722_create_table_message cannot be reverted.\n";

        return false;
    }
    */
}

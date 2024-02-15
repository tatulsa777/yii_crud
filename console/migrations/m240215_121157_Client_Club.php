<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client_club}}`.
 */
class m240215_121157_Client_Club extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%client_club}}', [
            'id' => $this->primaryKey(),
            'club_id' => $this->integer()->notNull(),
            'client_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk-client_club-club_id',
            '{{%client_club}}',
            'club_id',
            '{{%club}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-client_club-client_id',
            '{{%client_club}}',
            'client_id',
            '{{%client}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-client_club-club_id', '{{%client_club}}');
        $this->dropForeignKey('fk-client_club-client_id', '{{%client_club}}');

        $this->dropTable('{{%client_club}}');
    }
}

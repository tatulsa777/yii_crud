<?php

use yii\db\Migration;

/**
 * Class m240213_135450_Client
 */
class m240213_135450_Client extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240213_135450_Client cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up(): void
    {
        $this->createTable('{{%client}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string()->notNull(),
            'gender' => $this->string(),
            'birth_date' => $this->date(),
            'available_clubs' => $this->text(),
            'creation_date' => $this->dateTime(),
            'created_by' => $this->integer(),
            'update_date' => $this->dateTime(),
            'updated_by' => $this->integer(),
            'delete_date' => $this->dateTime(),
            'deleted_by' => $this->integer(),
        ]);
    }

    public function down(): void
    {
        $this->dropTable('{{%client}}');
    }

}

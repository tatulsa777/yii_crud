<?php

use yii\db\Migration;

/**
 * Class m240213_135450_Client
 */
class m240213_135450_Client extends Migration
{

    public function up(): void
    {
        $this->createTable('{{%client}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string()->notNull(),
            'gender' => $this->string(),
            'birth_date' => $this->date(),
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

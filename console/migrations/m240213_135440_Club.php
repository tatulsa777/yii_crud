<?php

use yii\db\Migration;

/**
 * Class m240213_135440_Club
 */
class m240213_135440_Club extends Migration
{

    public function up(): void
    {
        $this->createTable('{{%club}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'address' => $this->text(),
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
        $this->dropTable('{{%club}}');
    }

}

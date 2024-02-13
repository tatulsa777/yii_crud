<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "club".
 *
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property string|null $creation_date
 * @property int|null $created_by
 * @property string|null $update_date
 * @property int|null $updated_by
 * @property string|null $delete_date
 * @property int|null $deleted_by
 */
class Club extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'club';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['address'], 'string'],
            [['creation_date', 'update_date', 'delete_date'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'creation_date' => 'Creation Date',
            'created_by' => 'Created By',
            'update_date' => 'Update Date',
            'updated_by' => 'Updated By',
            'delete_date' => 'Delete Date',
            'deleted_by' => 'Deleted By',
        ];
    }
}

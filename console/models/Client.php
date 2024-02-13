<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string $full_name
 * @property string|null $gender
 * @property string|null $birth_date
 * @property string|null $available_clubs
 * @property string|null $creation_date
 * @property int|null $created_by
 * @property string|null $update_date
 * @property int|null $updated_by
 * @property string|null $delete_date
 * @property int|null $deleted_by
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name'], 'required'],
            [['birth_date', 'creation_date', 'update_date', 'delete_date'], 'safe'],
            [['available_clubs'], 'string'],
            [['created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['full_name', 'gender'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'gender' => 'Gender',
            'birth_date' => 'Birth Date',
            'available_clubs' => 'Available Clubs',
            'creation_date' => 'Creation Date',
            'created_by' => 'Created By',
            'update_date' => 'Update Date',
            'updated_by' => 'Updated By',
            'delete_date' => 'Delete Date',
            'deleted_by' => 'Deleted By',
        ];
    }
}

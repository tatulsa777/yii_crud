<?php

namespace backend\models;

use Yii;
use yii\base\InvalidConfigException;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use common\behaviors\SoftDeleteBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

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
class Club extends ActiveRecord
{
    const NOT_DELETED = 0;
    const DELETED = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'club';
    }

    /**
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getClients(): ActiveQuery
    {
        return $this->hasMany(Client::class, ['id' => 'client_id'])
            ->viaTable('{{%club_client}}', ['club_id' => 'id']);
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'creation_date',
                'updatedAtAttribute' => 'update_date',
                'value' => function () {
                    return Yii::$app->formatter->asDatetime('now', 'yyyy-MM-dd HH:mm:ss');
                },
            ],
            'blameable' => [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'softDelete' => [
                'class' => SoftDeleteBehavior::class,
                'softDeleteAttributeValues' => [
                    'delete_date' => new Expression('NOW()'),
                    'deleted_by' => Yii::$app->user->id,
                    'status' => self::DELETED,
                ],
                'restoreAttributeValues' => [
                    'delete_date' => null,
                    'deleted_by' => null,
                    'status' => self::NOT_DELETED,
                ],
                'replaceRegularDelete' => true,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
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
    public function attributeLabels(): array
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
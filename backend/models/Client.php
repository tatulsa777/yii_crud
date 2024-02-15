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
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string $full_name
 * @property string|null $gender
 * @property string|null $birth_date
 * @property string|null $creation_date
 * @property int|null $created_by
 * @property string|null $update_date
 * @property int|null $updated_by
 * @property string|null $delete_date
 * @property int|null $deleted_by
 */
class Client extends ActiveRecord
{
    const NOT_DELETED = 0;
    const DELETED = 1;
    public $club_ids;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'client';
    }

    /**
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getClubs(): ActiveQuery
    {
        return $this->hasMany(Club::class, ['id' => 'club_id'])
            ->viaTable('{{%client_club}}', ['client_id' => 'id']);
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
            [['full_name'], 'required'],
            [['birth_date', 'creation_date', 'update_date', 'delete_date'], 'safe'],
            [['club_ids'], 'each', 'rule' => ['integer']],
            [['created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['full_name', 'gender'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'gender' => 'Gender',
            'birth_date' => 'Birth Date',
            'creation_date' => 'Creation Date',
            'created_by' => 'Created By',
            'update_date' => 'Update Date',
            'updated_by' => 'Updated By',
            'delete_date' => 'Delete Date',
            'deleted_by' => 'Deleted By',
        ];
    }
}
<?php

namespace backend\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "client_club".
 *
 * @property int $id
 * @property int $club_id
 * @property int $client_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Client $client
 * @property Club $club
 */
class ClientClub extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client_club';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['club_id', 'client_id'], 'required'],
            [['club_id', 'client_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['client_id' => 'id']],
            [['club_id'], 'exist', 'skipOnError' => true, 'targetClass' => Club::class, 'targetAttribute' => ['club_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'club_id' => 'Club ID',
            'client_id' => 'Client ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return ActiveQuery
     */
    public function getClient(): ActiveQuery
    {
        return $this->hasOne(Client::class, ['id' => 'client_id']);
    }

    /**
     * Gets query for [[Club]].
     *
     * @return ActiveQuery
     */
    public function getClub(): ActiveQuery
    {
        return $this->hasOne(Club::class, ['id' => 'club_id']);
    }
}

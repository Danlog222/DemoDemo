<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property int $department_id
 * @property string $date
 * @property int $status_id
 * @property int $user_id
 * @property string $created_at
 * @property string $description
 *
 * @property Department $department
 * @property Status $status
 * @property User $user
 */
class Application extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_id', 'date', 'status_id', 'user_id', 'description'], 'required'],
            [['department_id', 'status_id', 'user_id'], 'integer'],
            [['date', 'created_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::class, 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'department_id' => 'Department ID',
            'date' => 'Date',
            'status_id' => 'Status ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::class, ['id' => 'department_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}

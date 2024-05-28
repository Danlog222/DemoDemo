<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property int $id
 * @property string $full_name
 * @property string $phone
 * @property string $feedback
 * @property string $image
 * @property string $created_at
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'phone', 'feedback', 'image'], 'required'],
            [['feedback'], 'string'],
            [['created_at'], 'safe'],
            [['full_name', 'phone', 'image'], 'string', 'max' => 255],
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
            'phone' => 'Phone',
            'feedback' => 'Feedback',
            'image' => 'Image',
            'created_at' => 'Created At',
        ];
    }
}

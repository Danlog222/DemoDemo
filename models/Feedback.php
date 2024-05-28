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

    public bool $rules = false;

    public $imageFile;
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
            [['full_name', 'phone', 'feedback',], 'required'],
            [['created_at'], 'safe'],
            [['full_name', 'phone', 'feedback'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg, jpeg, png'],
            [['rules'], 'required', 'requiredValue' => 1, 'message' => 'Отметка поля обязательна'],
            ['feedback', 'match', 'pattern' => '/^[а-яёА-ЯЁ\s-]+$/u'],
            ['feedback' , 'string', 'min' => '20'],
            ['full_name', 'match', 'pattern' => '/^([а-яёА-ЯЁ]+\s){2}([а-яёА-ЯЁ\-])+$/u'],
            // ['full_name', 'match', 'pattern' => '/^([а-яёА-ЯЁ\s\-]+\s){2}[а-яёА-ЯЁ\s\-\s]+$/u'],
            ['phone', 'match', 'pattern' => '/^\+7\(\d{3}\)\-\d{3}\-\d{2}\-\d{2}$/'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'ФИО',
            'phone' => 'Телефон',
            'feedback' => 'Отзыв',
            'imageFile' => 'Фото',
            'created_at' => 'Временная метка',
            'rules' => 'Согласие на обработку персональных данных',
        ];
    }
    public function upload($attr = 'image')
    {
        $this->$attr = Yii::$app->security->generateRandomString() . '.' . $this->imageFile->extension;
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->$attr);
            return true;
        } else {
            return false;
        }
    }
}

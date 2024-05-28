<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "User".
 *
 * @property int $id
 * @property string $full_name
 * @property string $login
 * @property string $email
 * @property string $document
 * @property string $password
 * @property string $phone
 * @property int $auth_key
 * @property int $role_id
 *
 * @property Application[] $applications
 * @property Role $role
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'User';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'login', 'email', 'document', 'password', 'phone', 'auth_key', 'role_id'], 'required'],
            [['auth_key', 'role_id'], 'integer'],
            [['full_name', 'login', 'email', 'document', 'password', 'phone'], 'string', 'max' => 255],
            [['login'], 'unique'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
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
            'login' => 'Login',
            'email' => 'Email',
            'document' => 'Document',
            'password' => 'Password',
            'phone' => 'Phone',
            'auth_key' => 'Auth Key',
            'role_id' => 'Role ID',
        ];
    }

    /**
     * Gets query for [[Applications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }
    
    public static function FindbyEmail($email){
        return self::findOne(['email' => $email]);
    }
    
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password,$this->password);
    }
    

}

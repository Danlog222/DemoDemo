<?php

namespace app\models;

use Yii;
use yii\helpers\VarDumper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $full_name
 * @property string $login
 * @property string $email
 * @property string $passport
 * @property string $password
 * @property string $phone
 * @property int $role_id
 * @property string $auth_key
 * @property int $category_id
 *
 * @property Application[] $applications
 * @property Category $category
 * @property Role $role
 */
class RegisterForm extends \yii\base\Model
{
    public string $full_name = '';
    public string $login = '';
    public string $email = '';
    public string $passport = '';
    public string $password = '';
    public string $phone = '';
    public int $category_id = 0;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'login', 'email', 'passport', 'password', 'phone','category_id'], 'required'],
            [['full_name', 'login', 'email', 'passport', 'password', 'phone',], 'string', 'max' => 255],
            [['email'], 'unique', 'targetClass' => User::class,],
            [['login'], 'unique', 'targetClass' => User::class,],
            ['email', 'email'],
            ['full_name', 'match', 'pattern' => '/^[а-яёА-ЯЁ\s]+$/u'],
            ['login', 'match', 'pattern' => '/^[a-zA-Z0-9\-]+$/'],
            ['passport', 'match', 'pattern' => '/^\d{4}\s\d{6}$/'],
            ['password', 'match', 'pattern' => '/^[a-zA-Z0-9]+$/'],
            ['password', 'string', 'min' => 6], 
            ['phone', 'match', 'pattern' => '/^\+7\(\d{3}\)\-\d{3}\-\d{2}\-\d{2}$/'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'full_name' => 'ФИО',
            'login' => 'Логин',
            'email' => 'Email',
            'passport' => 'Серия и номер пасспорта',
            'password' => 'Пароль',
            'phone' => 'Телефон',
            'role_id' => 'Роль в системе',
            'auth_key' => 'Auth Key',
            'category_id' => 'Категоиря граждан',
            'rules' => 'Пользовательское соглашение',
        ];
    }
 public function registerUser(){
    if ($this->validate()) {
        $user = new User();
        $user->attributes = $this->attributes;
        
        $user->password = Yii::$app->security->generatePasswordHash($this->password);
        $user->auth_key = Yii::$app->security->generateRandomString();
        $user->role_id = Role::getRoleId('user');
        
        if(!$user->save()){
            VarDumper::dump($user->errros,10,true);die;
        }
    }
    return $user ?? false;
 }
}

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
    public bool $rules = false;
    
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
            [['email'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'email'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            ['email', 'email'],
            [['rules'],'required', 'requiredValue' => 1, 'message' => 'пользовательское соглашение должно быть отмечено'],
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
            'passport' => 'Passport',
            'password' => 'Password',
            'phone' => 'Phone',
            'role_id' => 'Role ID',
            'auth_key' => 'Auth Key',
            'category_id' => 'Category ID',
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

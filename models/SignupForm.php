<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    const STATUS_ADMINISTATOR = 1;
    const STATUS_SIMPLE_USER = 0;

    public $username;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->type = self::STATUS_SIMPLE_USER;

        $user->generateAuthKey();
        $user->generateEmailVerificationToken();


        //пользователь будет активен сразу после регистрации(подтверждать на почте ничего не надо)
        $user->status = User::STATUS_ACTIVE;
        return $user->save();

    }
}

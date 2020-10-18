<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 * @property Task[] $tasks
 */
class User extends UserBase implements IdentityInterface
{
    public $password;
    public $repeat_password;
    public $token;
    public $avaReal;

    private const SCENARIO_SIGN_UP = 'signUp';
    private const SCENARIO_SIGN_IN = 'signIn';

    public function scenarioSignUp(){
        $this->scenario = self::SCENARIO_SIGN_UP;
    }

    public function scenarioSignIn(){
        $this->scenario = self::SCENARIO_SIGN_IN;
    }

    public function scenarios() {
        return [
            self::SCENARIO_SIGN_UP => ['email', 'password', 'repeat_password'],
            self::SCENARIO_SIGN_IN => ['email', 'password'],
        ];
    }

    public function beforeValidate() {
        if (!$this->timezone) {
            $this->timezone = 'Europe/Moscow';
            $this->offset_UTC = 3;
        }

        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }


    public function rules()
    {
        return array_merge([
            ['avaReal','file', 'extensions' => ['jpg', 'png', 'jpeg'], 'maxFiles' => 1],
            ['password', 'required','when'=> function ($model) {return !\Yii::$app->request->isAjax;}],
            ['repeat_password', 'compare', 'compareAttribute' => 'password','on'=> self::SCENARIO_SIGN_UP, 'message' => 'Пароли должны совпадать'],
            ['repeat_password', 'required', 'message' => 'Необходимо повторить пароль'],
            [['email'], 'unique','on'=> self::SCENARIO_SIGN_UP, 'message' => 'Такой адрес уже зарегистрирован'],
            [['email'], 'validateEmail','on'=> self::SCENARIO_SIGN_IN, 'message' => 'Неверный адрес или пароль'],
        ], parent::rules());
    }

    public function validateEmail() {
        $user = User::getUserByEmail($this->email);
        if (!$user) {
            $this->addError('email', 'Неверная электронная почта или пароль');
            $this->addError('password', 'Неверная электронная почта или пароль');
        }
    }

    public function getUserEmail($id) {
        $user = $this->findIdentity($id);
        return $user->email;
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return User::find()->andWhere(['id' => $id])->one();
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function getUserByEmail($email) {
        return User::find()->andWhere(['email'=>$email])->one();
    }

    /**
     * @return int|string current user ID
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return int|string current user email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @return int|string current user timezone
     */
    public function getTimezone() {
        return $this->timezone;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }


    public function fields()
    {
        return [
            'email' => $this->email,
            'pass_hash' => $this->passHash,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return array_merge([
            'password' => Yii::t('app', 'Пароль'),
            'repeat_password' => Yii::t('app', 'Повтор пароля'),
        ], parent::attributeLabels());
    }
}

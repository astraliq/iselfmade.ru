<?php
use yii\helpers\Html;

if ($user->mentor_email_confirm != 1) {
    $confirmCuratorBtnClass = '';
    $confirmCuratorClass = 'failure_icon';
} else {
    $confirmCuratorBtnClass = 'hidden_block';
    $confirmCuratorClass = 'success_icon';
}

if ($user->mentor_access_token != null) {
    $confirmCuratorBtnClass = 'hidden_block';
}

if (!$user->mentor_email) {
    $confirmCuratorBtnClass = 'hidden_block';
    $confirmCuratorClass = '';
}

?>

<div class="row">
    <div class="user_profile">
        <?php $form = \yii\bootstrap\ActiveForm::begin([
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
            'options' => ['class' => 'profile_form', 'enctype' => 'multipart/form-data'],
        ]);?>
        <?=$form->field($user,'email')->textInput(['readOnly' => true]);?>
        <?=$form->field($user,'name')->textInput(['autocomplete' => 'name']);?>
        <?=$form->field($user,'surname')->textInput(['autocomplete' => 'family-name']);?>
        <?=$form->field($user,'birthday')->input('date');?>
        <?=$form->field($user,'sex')->dropDownList($user::SEX, ['options' => [ '1' => ['Selected' => true]], 'autocomplete' => 'sex']);?>
        <?=$form->field($user,'phone_number')->input('phone');?>
        <?=$form->field($user,'timezone')->dropDownList($timezones, ['options' => [ $user->timezoneKeyNumber => ['Selected' => true]]]);?>
        <?=$form->field($user,'avaReal')->fileInput(['multiple' => false,]);?>
        <div class="user_profile-curator">
            <?=$form->field($user,'mentor_email')->input('text',['class' => 'form-control curators_emails']);?>
            <span class="<?=$confirmCuratorClass?>" id="curators_emails_confirm"></span>
            <button class="<?=$confirmCuratorBtnClass?>" id="curators_emails_btn_conf" <?=$confirmCuratorBtnActive?>>Подтвердить</button>
            <?=$form->field($user,'mentor_email_repeat')->dropDownList($user::REPEAT_CURATOR, ['options' => [ '1' => ['Selected' => true]], 'autocomplete' => 'sex']);?>
        </div>
        <div class="user_profile-psw">
            <?=$form->field($user,'password',['enableClientValidation'=>false])->passwordInput(['type' => 'password', 'autocomplete' => 'new-password'])->label('Новый пароль');?>
            <?=$form->field($user,'repeat_password',['enableClientValidation'=>false])->passwordInput(['type' => 'password', 'autocomplete' => 'new-password'])->label('Повтор нового пароля');?>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>

<?php echo $this->render('/modals/confirm_email', ['notifConfEmail' => $notifConfEmail]); ?>
<?php echo $this->render('/modals/confirm_curators_email'); ?>
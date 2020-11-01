<?php

namespace app\models;

use app\components\EncryptComponent;
use Yii;

class ArchiveTasks extends ArchiveTasksBase {


    public function afterFind() {
        parent::afterFind();
    }


    public function beforeValidate() {
        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }

    public function afterValidate() {
        parent::afterValidate(); // TODO: Change the autogenerated stub
    }


    public function beforeSave($insert) {
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

//    public static function primaryKey() {
//        return 'id';
//    }

    public function afterSave($insert, $changedAttributes) {
        return parent::afterSave($insert, $changedAttributes);
    }


    public function rules() {
        return array_merge([
//            ['type_id', 'in', 'range' => array_keys(self::TYPE_TASK)],
//            [['task'], 'trim'],
//            [['task'],'required'],
//            ['task','string','min' => 2,'max' => 250],
//            [['private_id','repeat_type_id'],'integer'],
//            ['private_id', 'in', 'range' => array_keys(self::TASK_PRIVATE)],
//            ['date_calculate', 'date', 'format' => 'php: Y-m-d H:i:s'],
//            [['nextPeriod', 'date_create_view', 'date_calculate_view'], 'safe'],
//            ['aim_id', 'value' => null, 'when' => function($model) {
//                return !$model->type_id == 1 || !$model->type_id == 2;
//            }],
//            ['goal_id', 'value' => null, 'when' => function($model) {
//                return !$model->type_id == 2;
//            }],
//            [['email','files'], 'default', 'value' => null],
//            ['file','file', 'extensions' => ['jpg', 'png', 'jpeg']],
        ],parent::rules()); // TODO: Change the autogenerated stub
    }

    public function attributeLabels() {
        $labels = parent::attributeLabels(); // TODO: Change the autogenerated stub
//        $labels['type_id'] = \Yii::t('app', 'Тип задачи');
//        $labels['task'] = \Yii::t('app', 'Сделать:');
//        $labels['hashtags'] = \Yii::t('app', 'Список хештегов через пробел:');
//        $labels['date_calculate'] = \Yii::t('app', 'Завершить:');
        return $labels;
    }


}

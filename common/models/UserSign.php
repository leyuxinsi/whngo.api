<?php
namespace common\models;

/**
 * 用户签到模型
 * @property int $sign_id
 * @property int $user_id
 * @property int $type
 * @property int $coach_id
 * @property int $create_time
 * @property int $reserve_id
 */
class UserSign extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_sign}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['user_id','type','coach_id','create_time','reserve_id'], 'required'],
            [['sign_id'],'safe']
        ];
    }
}

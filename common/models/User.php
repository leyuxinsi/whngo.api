<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;

/**
 * 用户模型类
 * @property int $user_id
 * @property string $user_nickname
 * @property string $headimg
 * @property string $status
 * @property string $cover
 */
class User extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_nickname','headimg'],'trim'],
            [['user_nickname','headimg'],'required'],
            [['user_id','status','cover'],'safe']
        ];
    }
}

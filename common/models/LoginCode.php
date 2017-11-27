<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use yii\base\NotSupportedException;
/**
 * 教练信息表
 *
 * @property int $code_id
 * @property int $user_id
 * @property int $code
 */
class LoginCode extends BaseModel
{

    const STATUS_ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%login_code}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['user_id', 'code'], 'required'],
            [['code_id'],'safe']
        ];
    }
}

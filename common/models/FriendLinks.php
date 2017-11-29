<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use yii\base\NotSupportedException;
/**
 * 友情链接管理
 *
 * @property int $link_id
 * @property string $name
 * @property string $website_url
 */
class FriendLinks extends BaseModel
{

    const STATUS_ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%friend_links}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['name','website_url'],'trim'],
            [['link_id'],'safe']
        ];
    }
}

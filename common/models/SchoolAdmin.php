<?php
namespace common\models;
use yii\data\Pagination;
use yii\db\Query;

/**
 * 驾校真实登录账号、密码表
 * @property int $admin_id
 * @property string $name
 * @property string $pwd
 * @property int $sc_id
 * @property int $state
 * @property int $group_id
 * @property string $showname
 */
class SchoolAdmin extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%school}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['name','pwd','showname'],'trim'],
            [['name', 'pwd', 'sc_id','showname'], 'required'],
            ['name','string', 'max' => 30,'tooLong'=>"名称不能超过30个字"],
            [['admin_id','state','showname'],'safe']
        ];
    }
}

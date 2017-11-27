<?php
namespace common\models;

/**
 * 网站配置信息表
 * @property int $conf_id
 * @property string $conf_key
 * @property string $conf_value
 * @property string $conf_remark
 */
class Config extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%config}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['conf_key','conf_value','conf_remark'],'trim'],
            [['conf_key', 'conf_value'], 'required'],
            ['conf_key','string', 'max' => 20,'tooLong'=>"配置KEY不能超过20个字符"],
            [['conf_id','conf_remark'],'safe']
        ];
    }
}

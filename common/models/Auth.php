<?php
namespace common\models;

/**
 * 教练信息表
 *
 * @property int $ban_id
 * @property string $ban_name
 * @property string $ban_columns
 * @property string $ban_img_url
 * @property string $ban_link
 * @property string $ban_target
 * @property string $ban_status
 * @property string $ban_sort
 * @property int $delete_flag
 */
class Auth extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%banner}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['ban_name','ban_link'],'trim'],
            [['ban_name'], 'required'],
            ['ban_name','string', 'max' => 50,'tooLong'=>"banner标题不能超过50个字"],
            [['ban_id','ban_sort','ban_status','ban_img_url','ban_columns','ban_target','delete_flag','ban_link'],'safe']
        ];
    }
}

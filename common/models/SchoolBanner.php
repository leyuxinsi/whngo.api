<?php
namespace common\models;

/**
 * 教练信息表
 *
 * @property int $ban_id
 * @property string $img_url
 * @property int $school_id
 * @property int $delete_flag
 */
class SchoolBanner extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%school_banner}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['img_url', 'school_id'], 'required'],
            [['school_id','ban_id','delete_flag'],'number'],
        ];
    }
}

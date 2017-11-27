<?php
namespace common\models;

/**
 * 教练信息表
 *
 * @property int $type_id
 * @property string $name
 */
class LicenseType extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%license_type}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['type_id'],'safe']
        ];
    }
}

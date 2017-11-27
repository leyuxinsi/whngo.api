<?php
namespace common\models;

/**
 * 教练信息表
 *
 * @property int $cert_id
 * @property string $name
 */
class CoachCert extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%coach_cert}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['name'],'trim'],
            [['name'], 'required'],
            ['name','string', 'max' => 10,'tooLong'=>"标题不能超过10个字"],
            [['cert_id'],'safe']
        ];
    }
}

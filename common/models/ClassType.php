<?php
namespace common\models;

/**
 * 班级分类模型
 * @property int $type_id
 * @property string $name
 */
class ClassType extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%class_type}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['name'],'trim'],
            [['name'], 'required'],
            ['name','string', 'max' => 10,'tooLong'=>"名称不能超过10个字"],
            [['type_id'],'safe']
        ];
    }
}

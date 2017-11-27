<?php
namespace common\models;

/**
 * 教练信息表
 *
 * @property int $coach_subject_id
 * @property int $coach_id
 * @property int $subject_id
 */
class CoachSubject extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%coach_subject}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['coach_id', 'subject_id'], 'required'],
            [['coach_subject_id'],'safe']
        ];
    }
}

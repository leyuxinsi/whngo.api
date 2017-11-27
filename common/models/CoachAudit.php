<?php
namespace common\models;

/**
 * 教练信息表
 *
 * @property int $audit_id
 * @property int $cert_id
 * @property string $cover
 * @property int $coach_id
 * @property string $remark
 */
class CoachAudit extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%coach_audit}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['remark'],'trim'],
            [['cover','coach_id','cert_id'], 'required'],
            ['remark','string', 'max' => 100,'tooLong'=>"备注不能超过100个字"],
        ];
    }
}

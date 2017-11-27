<?php
namespace common\models;

/**
 * 速约官方设定的驾校班级信息
 *
 * @property int $level_id
 * @property string $name
 * @property string $summary
 * @property float $original_price
 * @property float $original_price_max
 * @property int $day_max_order 每天最多预约数量
 * @property int $week_mak_order 每周最多预约数量
 * @property int $create_time 创建时间
 * @property int $status 状态 1：正常；9：修业
 * @property float $discount 最低折扣
 * @property float $discount_max 最高折扣
 * @property int $advance_days 可以提前预约的天数
 * @property string $study_step 学习流程，富文本
 * @property int $license_type 驾照类别
 * @property int $class_type 班级类别
 */
class ClassSuyue extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%class_suyue}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['name','summary','original_price','original_price_max','day_max_order','week_max_order','discount','discount_max','advance_days'],'trim'],
            [['cover', 'original_price', 'original_price_max','day_max_order','week_max_order','create_time','discount','discount_max','advance_days','license_type','class_type'], 'required'],
            [['level_id','content','promise','prise_details','status','student_amount'],'safe']
        ];
    }
}

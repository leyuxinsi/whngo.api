<?php
namespace common\models;

/**
 * 支付日志模型
 * @property int $log_id
 * @property string $order_number
 * @property float $pay_amount
 * @property int $pay_time
 * @property int $pay_type
 * @property string $pay_trade_no
 * @property string $pay_result
 */
class PayLog extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pay_log}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['order_number','pay_amount','pay_time','pay_type'], 'required'],
            [['pay_trade_no','pay_result','log_id'],'safe']
        ];
    }
}

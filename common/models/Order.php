<?php
namespace common\models;

/**
 * 教练信息表
 *
 * @property int $order_id
 * @property int $user_id
 * @property int $coach_id
 * @property int $class_level
 * @property string $order_number
 * @property int $create_time
 * @property int $complete_time
 * @property int $confirm_time
 * @property string $remark
 * @property float $total_price
 * @property int $status
 * @property float $discount
 * @property float $red_bag
 * @property int $type
 * @property int $pay_type
 * @property int $real_pay_amount
 */
class Order extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['remark'],'trim'],
            [['user_id','class_level','order_number','create_time','total_price','type','pay_type','real_pay_amount'], 'required'],
            [['order_id','coach_id','complete_time','confirm_time','status','discount','red_bag'],'safe']
        ];
    }

    /**
     * 将订单信息插入数据库
     * @param int $user_id
     * @param array $request
     * @param string $order_number
     * @return bool
     */
    public function insertOrder($user_id , $order_number, $request)
    {
        $this->user_id = $user_id;
        $this->class_level = $request['level_id'];
        $this->order_number = $order_number;
        $this->create_time = time();
        $this->total_price = $request['price'];
        $this->status = 1;
        $this->discount = $request['discount'];
        $this->type = 1;
        $this->pay_type = $request['pay_type'];
        $this->real_pay_amount = $request['real_pay_amount'];
        if(!$this->save()){
            $this->returnError();
        }
        return true;
    }

    /**
     * 获取订单详情
     * @param string $order_number
     * @param int $user_id
     * @return array
     */
    public static function findOrderDetails($order_number,$user_id)
    {
        return self::find()
            ->select([
                'cl.name level_name',
                's.name school_name',
                's.discount_price school_discount',
                'su_order.order_number',
                'su_order.real_pay_amount',
                'su_order.pay_type',
                'su_order.total_price',
                'su_order.create_time',
            ])
            ->innerJoin('su_class_level cl','cl.level_id=su_order.class_level')
            ->innerJoin('su_school s','s.school_id=cl.school_id')
            ->where(['su_order.order_number'=>$order_number,'su_order.user_id'=>$user_id])
            ->asArray()->one();
    }
}

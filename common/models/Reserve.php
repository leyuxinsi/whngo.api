<?php
namespace common\models;

/**
 * 用户预约表
 *
 * @property int $reserve_id 预约ID
 * @property int $user_id 用户ID
 * @property int $coach_id 教练ID
 * @property int $table_time_id 预约时刻表ID
 * @property int $create_time 预约时间
 * @property int $status 1：成功；9：取消
 * @property int $car_id 车辆ID
 * @property int $class_over 1：已经上课，0：未上课
 * @property int $scan 0：未签到；1：已经扫码
 */
class Reserve extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%reserve}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['user_id', 'coach_id', 'table_time_id','create_time','car_id'], 'required'],
            [['reserve_id','status','class_over','scan'],'number'],
        ];
    }
}

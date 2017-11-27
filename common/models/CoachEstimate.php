<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\data\Pagination;
use yii\db\Query;

/**
 * User model
 *
 * @property int $level_id
 * @property string $name
 * @property int $school_id
 * @property string $summary
 * @property string $rule
 */
class CoachEstimate extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%coach_estimate}}';
    }

    /**
     * 添加笔袋
     */
    /*public function rules()
    {
        return [
            [['bag_name','bag_summary'],'trim'],
            [['bag_name', 'user_id', 'bag_summary','create_time'], 'required'],
            [['bag_name','bag_summary'],'filter','filter'=>'htmlspecialchars','skipOnArray'=>true,'on'=>['create','update']],
            ['type', 'in', 'range' => [0,1]],
            ['bag_name','string', 'max' => 50,'tooLong'=>"笔袋标题不能超过50个字"],
            ['bag_summary','string', 'max' => 100,'tooLong'=>"笔袋内容简介不能超过100个字"],
            [['delete_flag','sour_amount','focus_amount'],'number'],
            [['bag_cover','bag_sort','dy_amount'],'safe']
        ];
    }*/
}

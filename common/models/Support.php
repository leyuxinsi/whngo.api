<?php
namespace common\models;

use yii\data\Pagination;

/**
 *
 *
 * @property int $support_id
 * @property int $user_id
 * @property float $payment
 * @property int $pro_id
 * @property float $support_amount
 * @property string $order_number
 * @property string $word
 * @property int $create_time
 * @property int $status
 * @property float $total_price
 */
class Support extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%support}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['word'],'trim'],
            [['user_id','payment','pro_id','support_amount','order_number','word','create_time','total_price'], 'required'],
            [['support_id','status','support_amount','focus_amount','status','create_time','delete_flag'],'safe']
        ];
    }

    /**
     * 获取项目下面的所有支持信息
     * @param int $pro_id 项目ID
     * @param int $page
     * @param int $page_size
     * @return array
     */
    public static function findListByProId($pro_id,$page,$page_size)
    {
        $query = self::find()->where(['w_support.status'=>self::STATUS_ACTIVE,'w_support.pro_id'=>$pro_id]);
        $count = $query->count();
        $list = $query
            ->addSelect([
                'w_support.support_id',
                'w_support.word',
                'w_support.total_price',
                'w_support.create_time',
                'u.user_nickname',
                'u.headimg',
            ])
            ->innerJoin('w_user u','u.user_id=w_support.user_id')
            ->innerJoin('w_project p','p.pro_id=w_support.pro_id')
            ->offset(($page-1)*$page_size)
            ->limit($page_size)
            ->orderBy('w_support.create_time desc')
            ->asArray()->all();

        return ['list'=>$list , 'count'=>$count];
    }

    /**
     * 获取最新的评论记录
     * @param int $limit
     * @param string $sort
     * @return array
     */
    public static function findLastSupport($limit=5,$sort='support_id desc'){
        return Support::find()
            ->select([
                'u.user_nickname',
                'u.headimg',
                'w_support.word',
                'w_support.total_price',
                'FROM_UNIXTIME(w_support.create_time) AS create_time'
            ])
            ->innerJoin('w_user u','u.user_id=w_support.user_id')
            ->where(['w_support.status'=>"1"])
            ->limit($limit)
            ->orderBy($sort)
            ->asArray()->all();
    }
}

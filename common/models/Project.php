<?php
namespace common\models;

use yii\data\Pagination;

/**
 *
 *
 * @property int $pro_id
 * @property string $pro_name
 * @property string $pro_company
 * @property string $record_number 登记证号
 * @property string $user_truename 负责人姓名
 * @property int $user_phone
 * @property string $user_address
 * @property string $pro_content 项目详细介绍内容
 * @property int $pro_type 项目类型ID
 * @property int $user_id
 * @property float $funds_amount
 * @property int $support_amount
 * @property int $focus_amount
 * @property int $status
 * @property int $create_time
 * @property int $delete_flag
 */
class Project extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%project}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['pro_name', 'pro_company', 'record_number', 'user_truename', 'user_phone', 'user_address',],'trim'],
            [['pro_name','pro_company','record_number','user_truename','user_phone','user_address','user_id','pro_content','pro_type'], 'required'],
            [['pro_id','funds_amount','support_amount','focus_amount','status','create_time','delete_flag'],'safe']
        ];
    }

    /**
     * 获取所有项目列表
     * @param int $page_size
     * @param int $page
     * @return array
     */
    public static function findList($page , $page_size)
    {
        $query = self::find()->where(['w_project.status'=>self::STATUS_ACTIVE,'w_project.delete_flag'=>self::DELETE_FALSE]);
        $count = $query->count();
        $list = $query->
        addSelect([
            'w_project.pro_id',
            'w_project.pro_name',
            'w_project.pro_company',
            'w_project.pro_content',
            'w_project.record_number',
            'w_project.user_truename',
            'w_project.user_phone',
            'w_project.user_address',
            'w_project.funds_amount',
            'w_project.support_amount',
            'w_project.focus_amount',
            'pt.type_name',
            'u.user_nickname',
            'u.headimg',
        ])
            ->innerJoin('w_project_type pt','pt.type_id=w_project.pro_type')
            ->innerJoin('w_user u','u.user_id=w_project.user_id')
            ->offset(($page-1)*$page_size)
            ->limit($page_size)
            ->orderBy('w_project.funds_amount desc')
            ->asArray()->all();

        return ['list'=>$list , 'count'=>$count];
    }

    /**
     * 获取项目详细信息
     * @param int $pro_id 项目ID
     * @return array
     */
    public static function findById($pro_id)
    {
        return self::find()
            ->select([
                //'w_project.pro_id',
                'w_project.pro_name',
                'w_project.pro_company',
                'w_project.pro_content',
                //'w_project.record_number',
                'w_project.user_truename',
                //'w_project.user_phone',
                //'w_project.user_address',
                'w_project.funds_amount',
                'w_project.support_amount',
                'w_project.focus_amount',
                //'pt.type_name',
                'u.user_nickname',
                'u.headimg',
            ])
            ->where(['w_project.status'=>self::STATUS_ACTIVE,'w_project.delete_flag'=>self::DELETE_FALSE,'w_project.pro_id'=>$pro_id])
            ->innerJoin('w_project_type pt','pt.type_id=w_project.pro_type')
            ->innerJoin('w_user u','u.user_id=w_project.user_id')
            ->asArray()->one();
    }
}

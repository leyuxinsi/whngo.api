<?php
namespace common\models;
use yii\data\Pagination;
use yii\db\Query;

/**
 * 教练信息表
 *
 * @property int $coach_id
 * @property string $truename
 * @property string $password
 * @property string $introduce
 * @property string $headimg
 * @property string $phone
 * @property float $pass_rate
 * @property int $type
 * @property int $province
 * @property int $city
 * @property int $area
 * @property string $address
 * @property float $star
 * @property int $sex
 * @property int $status
 * @property int $school_id
 * @property int $register_time
 * @property int $last_login_time
 * @property int $reverve_amount
 * @property int $coach_index_hot
 * @property int $reverve_limit
 * @property string $sharecode
 * @property int $num
 * @property int $student_amount
 */
class Coach extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%coach}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['truename','introduce','phone','address'],'trim'],
            [['headimg', 'phone', 'register_time','last_login_time','password','truename','school_id','introduce'], 'required'],
            ['truename','string', 'max' => 10,'tooLong'=>"姓名不能超过10个字"],
            ['introduce','string', 'max' => 100,'tooLong'=>"介绍不能超过100个字"],
            [['student_amount','reverve_limit','coach_index_hot','reverve_amount','school_id','status','sex','type'],'number'],
            [['sharecode','star','area','city','province','pass_rate'],'safe']
        ];
    }

    /**
     * 获取所有教练列表
     * @param array $where
     * @return array
     */
    public static function findList($where=[])
    {
        $query = (new Query())->from('su_coach as c');
        if($where){
            unset($where['page']);
            $query->andWhere($where);
        }

        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);

        $list = $query
            ->addSelect([
                'c.*',
                's.name as school_name',
                'rep.region_name as pro_name',
                'rec.region_name as city_name',
                'rea.region_name as area_name',
            ])
            ->innerJoin('su_school s','s.school_id=c.school_id')
            ->leftJoin('su_region rep','c.province=rep.region_id')
            ->leftJoin('su_region rec','c.city=rec.region_id')
            ->leftJoin('su_region rea','c.area=rea.region_id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('c.register_time desc')
            ->all();
        return ['list'=> $list , 'pagination'=>$pagination ,'count'=>$count];
    }
}

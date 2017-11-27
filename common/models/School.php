<?php
namespace common\models;
use yii\data\Pagination;
use yii\db\Query;

/**
 * 教练信息表
 *
 * @property int $school_id
 * @property string $name
 * @property string $account_name
 * @property string $password
 * @property string $headimg
 * @property string $phone
 * @property int $province
 * @property int $city
 * @property int $area
 * @property string $address
 * @property string $content
 * @property int $coach_amount
 * @property string $contact
 * @property int $status
 * @property float $start_price
 * @property float $discount_price
 * @property float $star
 * @property int $is_try
 * @property int $register_time
 * @property int $group_id
 * @property int $index_hot
 * @property int $lock_limit
 * @property int $time_limit
 * @property int $student_amount
 * @property float $longitude
 * @property float $latitude
 */
class School extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%school}}';
    }

    public function rules()
    {
        return [
            [['name','account_name','phone','address','content','contact','start_price','discount_price','star','longitude','latitude'],'trim'],
            [['name','account_name', 'phone','province','city','area','address','content','contact',''], 'required'],
            ['name','string', 'max' => 50,'tooLong'=>"驾校名称"],
            ['account_name','string', 'max' => 20,'tooLong'=>"账号不能超过20个字"],
            [[
                'school_id',
                'password',
                'headimg',
                'coach_amount',
                'status',
                'start_price',
                'discount_price',
                'star',
                'is_try',
                'register_time',
                'group_id',
                'index_hot',
                'lock_limit',
                'time_limit',
                'student_amount',
            ],'safe']
        ];
    }

    /**
     * 获取驾校列表
     * @param array $where 检索条件
     * @return array
     */
    public static function findList($where=[])
    {
        $query = (new Query())->from('su_school as s');
        if($where){
            $query->andWhere($where);
        }

        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);

        $list = $query
            ->addSelect([
                's.*',
                'rep.region_name as pro_name',
                'rec.region_name as city_name',
                'rea.region_name as area_name',
            ])
            ->leftJoin('su_region rep','s.province=rep.region_id')
            ->leftJoin('su_region rec','s.city=rec.region_id')
            ->leftJoin('su_region rea','s.area=rea.region_id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('s.index_hot desc,s.register_time desc')
            ->all();
        return ['list'=> $list , 'pagination'=>$pagination ,'count'=>$count];
    }
}

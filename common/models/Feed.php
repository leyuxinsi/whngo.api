<?php
namespace common\models;
use yii\data\Pagination;

/**
 * 动态
 * @property int $feed_id
 * @property string $content
 * @property int $create_time
 * @property int $status
 * @property string $img_url
 */
class Feed extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%feed}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['feed_id', 'content', 'create_time'], 'required'],
            [['status','img_url'],'safe']
        ];
    }

    /**
     * 获取全部列表
     */
    public static function findList()
    {
        $query = self::find()->where(['status'=>self::STATUS_ACTIVE]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $list = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('create_time desc')
            ->asArray()->all();

        return ['list'=>$list , 'pagination'=>$pagination , 'count'=>$count];
    }

    public static function findListsByLimit($limit=4)
    {
        return self::find()->select([
            'content',
            'create_time',
            'img_url',
        ])->where(['status'=>self::STATUS_ACTIVE])->limit($limit)->asArray()->all();
    }
}

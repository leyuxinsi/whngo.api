<?php
namespace common\models;

use yii\data\Pagination;

/**
 * 新闻动态表
 * @property int $news_id
 * @property string $news_img
 * @property string $title
 * @property string $summary
 * @property string $content
 * @property int $create_time
 * @property int $status
 */
class News extends BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['news_img','title','summary','content'],'trim'],
            [['title', 'summary','content','create_time'], 'required'],
            ['title','string', 'max' => 100,'tooLong'=>"标题不能超过100个字"],
            ['summary','string', 'max' => 100,'tooLong'=>"简介不能超过100个字"],
            [['news_id','status'],'safe']
        ];
    }

    /**
     * 检索列表
     * @param int $page_size
     * @param int $page
     * @return array
     */
    public static function findList($page,$page_size)
    {
        $query = self::find()->where(['status'=>self::STATUS_ACTIVE]);
        $count = $query->count();
        $list = $query
            ->offset(($page-1)*$page_size)
            ->limit($page_size)
            ->orderBy('create_time desc')
            ->asArray()->all();

        return ['list'=>$list , 'count'=>$count];
    }
}

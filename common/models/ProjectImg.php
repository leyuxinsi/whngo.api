<?php
namespace common\models;

use yii\data\Pagination;

/**
 *
 *
 * @property int $pro_img_id
 * @property string $img_src
 * @property int $pro_id
 * @property int $create_time
 * @property int $delete_flag
 */
class ProjectImg extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%project_img}}';
    }

    /**
     * 添加笔袋
     */
    public function rules()
    {
        return [
            [['img_src','pro_id','create_time'], 'required'],
            [['pro_img_id','delete_flag'],'safe']
        ];
    }
}

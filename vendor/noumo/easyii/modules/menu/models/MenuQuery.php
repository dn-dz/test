<?php

namespace yii\easyii\modules\menu\models;
use creocoder\nestedsets\NestedSetsQueryBehavior;
use yii\easyii\components\ActiveQuery;

class MenuQuery extends ActiveQuery
{
    public function onlyRoot()
    {
        return $this->andWhere(['parrent_page_id' => 0]);
    }

}
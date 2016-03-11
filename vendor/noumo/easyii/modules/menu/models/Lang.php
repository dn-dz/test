<?php
namespace yii\easyii\modules\menu\models;

use yii\db\ActiveRecord;

/**
 * Page module API
 * @package yii\easyii\modules\page\api
 *
 * @method static PageObject get(mixed $id_slug) Get page object by id or slug
 */

class Lang extends ActiveRecord
{
    public static function tableName()
    {
        return 'easyii_menus_lang';
    }
}
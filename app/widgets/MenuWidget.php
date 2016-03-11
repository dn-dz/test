<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\easyii\modules\menu\api\Menu;

class MenuWidget extends Widget
{
    public $html;

    public function init()
    {
        parent::init();

        $menu = new Menu();
        $m=$menu->loadMenu('');
        $items=array();
        $childrens = array();

        foreach($m as $item){
            $items[$item->page_id] = $item;
        }
        foreach ($items as $item) {
            if ($item->parrent_page_id) $childrens[$item->page_id] = $item->parrent_page_id; // Заполняем массив
        }
        foreach ($items as $item) {
            if (!$item->parrent_page_id) $this->html.=$menu->printItem($item, $items, $childrens); // Выводим все элементы верхнего уровня
        }
    }

    public function run()
    {
        return $this->html;
    }
}
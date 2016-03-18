<?php
namespace yii\easyii\modules\menu\api;


use Yii;
use yii\easyii\modules\menu\models\Menu as MenuModel;
use yii\easyii\modules\menu\models\Lang;
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\UrlManager;

/**
 * Page module API
 * @package yii\easyii\modules\page\api
 *
 * @method static PageObject get(mixed $id_slug) Get page object by id or slug
 */

class Menu extends \yii\easyii\components\API
{
    private $_pages = [];

/*    public function api_get($id_slug)
    {
        if(!isset($this->_pages[$id_slug])) {
            $this->_pages[$id_slug] = $this->findPage($id_slug);
        }
        return $this->_pages[$id_slug];
    }
*/
    private function findMenu($id_slug)
    {
        $curCode = Yii::$app->params['defaultLanguage'];
        foreach (Yii::$app->urlManager->languages as $code => $locale) {
            if (Yii::$app->language == $locale) {
                $curCode = $code;
            }
        }
        $menu = MenuModel::find()->all();

        return $menu ? new MenuObject($menu) : $this->notFound($id_slug);
    }

    public function loadMenu($pid){
        $curCode = Yii::$app->language;
        $curCode=$curCode[0].$curCode[1];
        $curCode=str_replace('ka', 'ge', $curCode);
        $title=array();
        $menu = MenuModel::find()->where(['or', 'isEnabled=1'])->orderBy('menu_position')->all();
        $lang = Lang::find()->where(['language' => $curCode])->all();
        foreach($lang as $lang){
            $title[$lang->page_id]=$lang->title;
        }
        $id=0;
        foreach($menu as $menu){
            if(!empty($title[$menu->page_id])){
                $menu->title=$title[$menu->page_id];
            }
            $m[$id]=$menu;
            $id++;
        }
        return $m;
    }

/*    private function notFound($id_slug)
    {
        $page = new MenuModel([
            'slug' => $id_slug
        ]);
        return new MenuObject($page);
    }
*/
    public function printItem($item, $items, $childrens) {
        /* Выводим пункт меню */
        $html="<li>";
        if($item->url==""){
            $item->url="#";
        }
        $html.="<a href='".Url::toRoute($item->url)."'>".$item->title."</a>";
        $ul = false; // Выводились ли дочерние элементы?
        while (true) {
            /* Бесконечный цикл, в котором мы ищем все дочерние элементы */
            $key = array_search($item->page_id, $childrens); // Ищем дочерний элемент
            if (!$key) {
                /* Дочерних элементов не найдено */
                if ($ul) $html.="</ul>"; // Если выводились дочерние элементы, то закрываем список
                break; // Выходим из цикла
            }
            unset($childrens[$key]); // Удаляем найденный элемент (чтобы он не выводился ещё раз)
            if (!$ul) {
                $html.="<ul>"; // Начинаем внутренний список, если дочерних элементов ещё не было
                $ul = true; // Устанавливаем флаг
            }
            $html.=$this->printItem($items[$key], $items, $childrens); // Рекурсивно выводим все дочерние элементы
        }
        $html.="</li>";

        return $html;
    }
}
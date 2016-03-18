<?php
use yii\easyii\modules\faq\api\Faq;
use yii\easyii\modules\page\api\Page;

$page = Page::get('page-faq');

$text =  $page->model->text;

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
?>
<h1><?= $page->seo('h1', $page->title) ?></h1>
<br/>

<?= $page->text ?>

<?php foreach(Faq::items() as $item) : ?>
    <p><b>Вопрос: </b><?= $item->question ?></p>
    <blockquote><b>Ответ: </b><?= $item->answer ?></blockquote>
<?php endforeach; ?>
<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Административный раздел';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       'Административный раздел'
    </p>
 <h1>сообщение модели</h1>
	
	<p> <?=$model->message;?></p> 
	
	
	<p><a class="btn btn-default" href=" <?=Url::to(['site/uploadenom']) ?>">Загрузить Номенклатуры из csv на сайте  </a></p>

    <code><//?= __FILE__ ?></code>
</div>

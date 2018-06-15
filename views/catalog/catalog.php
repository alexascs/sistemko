<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Каталог';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-catalog">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        КАТАЛОГ ТОВАРОВ  
    </p>
	<br>
	catalog model section :   <?=$model->section?>
    <br>
	
	<br>
	catalog model element:   <?=$model->element?>
    <br>
	<br>
	catalog model pagen:   <?=$model->pagen?>
    <br>
		<br>
	ajax model messaage:   <?//=$model->message?>
    <br>
	
	 
	 4  <a    href='<?=Url::to(['catalog/', 'section' => '5555', 'element'=> '777', 'pagen'=> '5',])?>'> <?=Url::to(['catalog/', 'section' => '5555', 'element'=> '777', 'pagen'=> '999',])?></a> 

    <code><//?= __FILE__ ?></code>
</div>

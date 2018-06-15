<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Каталог';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row"> 
<h1><?= Html::encode($this->title) ?></h1>		
    
	<div class="col-sm-4"  >

			<div class="site-catalog-left">
			

			<p>
			СЕКЦИИ КАТАЛОГА   
			</p>
			<br>
			catalog model section :   <?=$model->section?>
			<br>

			 <?
 echo 'сообщение модели'.$model->message;			 
				 
				 
				 
				 
			  ?>

			 
			 
			</div>

	</div>
	
	
	<div class="col-sm-8" style="background-color:yellow;">

			<div class="site-catalog-right">
			 
			<p>
			ЭЛЕМЕНТЫ КАТАЛОГА 
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

   <a    href='<?=Url::to(['catalog/', 'section' => '5555', 'element'=> '777', 'pagen'=> '5',])?>'> <?=Url::to(['catalog/', 'section' => '5555', 'element'=> '777', 'pagen'=> '999',])?></a> 

			 
			</div>

	</div>
</div>
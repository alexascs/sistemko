<?php

/* @var $this yii\web\View */


use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\LokalFileModel;





$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row"> 
	<div class="col-xs-12">
		<h1><?= Html::encode($this->title) ?></h1>
	</div>		
</div>
<div class="row">

  <div class="col-xs-12 col-md-3">
	
	<?php
				/* $mr = new CatalogMenuPresenter();
				$mr->sArr= $model->arrSectioons;
				$mr->oSecArr = $model->TopArrCurSection;
				$mr->render(); */
				
function printSection($arrSection,$cursection)
{
	  	 
	if (!isset($arrSection['id'])) {return;};
		
	if($arrSection['visible']){

		$qv=0;
		$q=0;

		foreach($arrSection['childArray']  as $k=>$el){
			if($el[visible])$qv=$qv+1;   
			
			$q=$q+1; 
			;}


		echo '<li>';
		echo '<a  href='.Url::to(['catalog/index', 'section' => $arrSection['id'], 'element' => 'non', 'page' => 0, ]) . ' >' . $arrSection['name']. '</a>'; 

		
		 
		
			if(!$qv==0){

			echo '<ul>';

			foreach($arrSection['childArray'] as $key =>$children){printSection($children,$cursection);}

			echo '</ul>';

			}else{ if($q>0&&$arrSection['id']==$cursection){
				
				echo '<ul>';

				 
			     foreach($arrSection['childArray'] as $key =>$children){
					 
					 
					 echo '<li>';
					 echo '<a  href='.Url::to(['catalog/index', 'section' => $children['id'], 'element' => 'non', 'page' => 0, ]) . ' >' . $children['name']. '</a>'; 
					 echo '</li>';
					 
				 }

			     echo '</ul>';
				
				
			}
				
				
				
				
			}
			
			
			
			
		
		echo '</li>';
	
	}
	
	 
	 
};
				
				
				echo '<ul class="sidebar-menu__root">';


				foreach ($catalogModel->arrSectioons as $topSection) {
				printSection($topSection,$catalogModel->section);
				};
				
				
				echo '</ul>';
				
				
			?>
	
     
    </div>






	<div class="col-xs-12 col-md-9">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Картинка</th>
					<th>Название</th>
					<th>Цена</th>
					<th>Количество</th>
					<th>Сумма</th>
					<th>Удалить</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($model->basketArray as $item) : ?>
					<tr>
						<td>
							<?php $img = isset($item['image']) ? "https://metropt.ru/upload/".$item['image'] : '/images/no-image.jpg' ?>
							<img class="img-responsive center-block" src="<?=$img;?>" alt="">
						</td>
						<td><?=$item['name']?></td>
						<td><?=$item['price']?></td>
						<td><?=$item['quantity']?></td>
						<td><?=$item['sum']?></td>
						<td>X</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		
			стоимость корзины <?=$model->basketSum;   ?>
			
			<br>	<br>
			
			
		<a href="<?=Url::to(['sale/order',]);?>" >
	 	<div class="form-group">
				<?= Html::submitButton('Оформить заказ', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
		 </div>
		 	</a>
		
		
	</div>
</div>
<div class="row"> 
	<div class="col-xs-12">
	
	</div>
</div>
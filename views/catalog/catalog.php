 <?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Каталог';
$this->params['breadcrumbs'][] = $this->title;
 
$session = Yii::$app->session;
$session->open();
/// we have to delete lasta element form  $model->TopArrCurSection   it is our top top super section
/// we have to delete lasta element form  $model->TopArrCurSection
$countTopArray = count($model->TopArrCurSection);
if ($countTopArray > 0) {
	unset($model->TopArrCurSection[array_search($model->section, $model->TopArrCurSection)]);
}; 
//add all of top sections 
if (isset($model->TopArrCurSection) && $countTopArray > 0) {
	$reverseArray = array_reverse($model->TopArrCurSection);
	foreach ($reverseArray as $val) {
		$this->params['breadcrumbs'][] = ['label' => $model->getSectionNameById($val), 'url' => [Url::to(['catalog/index', 'section' => $val, 'element' => 'non', 'page' => 0, ])]];
	};
};
$this->params['breadcrumbs'][] = ['label' => $model->getSectionNameById($model->section), 'url' => [Url::to(['catalog/index', 'section' => $model->section, 'element' => 'non', 'page' => 0, ])]];
?>

<div class="row"> 
<h1><?= Html::encode($this->title) ?></h1>		
    
	</div>
	<div class="row"> 
	
	<div class="col-sm-4"  >

			<div class="site-catalog-left">
			
<?function printSection($arrSection,$cursection)
{
	  
	if (!isset($arrSection['id'])) {return;};
			
	if($arrSection['visible']){
		$qv=0;
		$q=0;
		foreach($arrSection['childArray']  as $k=>$el){
			if($el[visible])$qv=$qv+1;   
			
			$q=$q+1; 
			;}
		echo '<li t='.$qv.'>';
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
echo '<ul>';
		foreach ($model->arrSectioons as $topSection) {
			printSection($topSection,$model->section);
		};
		echo '</ul>';
			?>
			
			
			</div>
			

	</div>
	
	
	<div class="col-sm-8" >

			<div class="site-catalog-right">
			  
		          <h1 id="section_name" ><?=$model->getSectionNameById($model->section)?></h1>
					<?php
					
					if($model->quantityPageForCurSection>1){
					
							for ($x=0; $x<$model->quantityPageForCurSection; $x++) {
								
								$pn=$x+1;
								echo '<a  href='.Url::to(['catalog/index', 'section' => $model->section, 'element'=> 'non', 'page'=> $x,]).' > '.$pn.'  </a>';    
								
								
								
								
							};
					
					};
					?>

			
          
			 <table class="table-bordered catalog-table">
			<thead>
				<tr>
					<th>Изображение</th>
					<th>Название</th>
					<th>Остатки</th>
					<th>Цена</th>
					<th>В корзину</th>
				</tr>
			</thead>
				<?php foreach($model->arrElements as $item) : ?>
				<tr>
				<td>
					<?php $img = ($item['image'] !== 'not') ? "https://metropt.ru/upload/".$item['image'] : '/images/no-image.jpg' ?>
					<img class="img-responsive center-block" src="<?=$img;?>" alt="">
				</td>
				<td><?=$item['name'];?></td>
				<td><?=$item['id'];?></td>
				<td><?=$item['price'];?></td>
				<td>
					<div class="basket-control clearfix">
						<input id="q<?=$item['id'];?>" data-ov="1" type="text" class="basket-control__input" placeholder="1" value="1">
						<button data-id="<?=$item['id'];?>" class="basket-control__button">Добавить</button>
					</div>
				</td>
				</tr>
				<?php endforeach; ?>
		</table>
  
  
			 
			</div>
<h1 id="message_div" ></h1>
		
		
			 
			</div>
            
	</div>
</div>




<script>
function btn_catalog_add_to_basket(data) {
    
   var xhttp = new XMLHttpRequest();
   
   var dataF = new FormData();
   dataF.append('elementid', data);
   dataF.append('quanty', '1');
   
   
   
   xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
      mes( this.responseText);
    }
  };
  xhttp.open("POST", "<?=Url::to(['catalog/addtobasketajax']) ?>", true);
  xhttp.send(dataF);
  t='input_'+data;
  quan=document.getElementById('input_'+data).value;
  
   console.log(quan)
 console.log(data)
 console.log("btn_catalog_add_to_bascet ")
}
function mes(mes){
	mes_div= document.getElementById('message_div').innerHTML=mes;
	
	
}
</script>

	 <?
 //echo 'сообщение модели'.$model->message;			 
	 
//echo 'секция модели  '.$model->section;		
       //print_r($model->arrSectioons);
		
		//echo '<br>';echo '<br>';echo '<br>';echo '<br>';
			
	//	print_r($model->arrElements);
		
		//  echo 'sections   <br>';echo '<br>';echo '<br>';echo '<br>';
	 	// print_r($model->arrSectioons );
		
	 
		
			  ?>
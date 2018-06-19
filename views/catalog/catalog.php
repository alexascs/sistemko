<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Каталог';

$this->params['breadcrumbs'][] =['label' => 'Подкатегория', 'url' => ['/site/index']];
$this->params['breadcrumbs'][] = $this->title;





function printSection($arrSection){
	
	 
	
	if(isset($arrSection)&&count($arrSection)>0){
		 
		echo '<ul>';
 
		
		//print_r($arrSection);
		foreach($arrSection as  $dataArray){
			
	    //	echo $dataArray['id'].'  '.$dataArray['name'];
		
		       //echo $dataArray['name'];   
					foreach($dataArray as  $data){
						
						echo '<li>';
						
						echo   '<a  href='.Url::to(['catalog/index', 'section' => $data['id'], 'element'=> 'non', 'page'=> 0,]).' >'.$data['name'].'</a>';    
						
				 
						if(count($data['childArray'])>0){printSection($data['childArray']);};
							echo '</li>';
						
					}
					
		
			
		}
		
		
			echo '</ul>';
		
		
		
		
	} 
	
	
	
	
	
	
};
?>

<div class="row"> 
<h1><?= Html::encode($this->title) ?></h1>		
    
	</div>
	<div class="row"> 
	
	<div class="col-sm-4"  >

			<div class="site-catalog-left">
			

			
			
			</div>
			
			<?
			
			
			
			printSection($model->arrSectioons)?>
			 
			 
			

	</div>
	
	
	<div class="col-sm-8" >

			<div class="site-catalog-right">
			 
		
		
			 
	 
			
			 
			
					<?php
					//$qp=ceil($model->quantityPageForCurSection);
					
					//echo '<br>  qp  = '.$qp.'<br>';
					if($model->quantityPageForCurSection>1){
					
							for ($x=0; $x<$model->quantityPageForCurSection; $x++) {
								
								$pn=$x+1;
								echo '<a  href='.Url::to(['catalog/index', 'section' => $model->section, 'element'=> 'non', 'page'=> $x,]).' > '.$pn.'  </a>';    
								
								
								
								
							};
					
					};
					?>

			
			
			
			
            
			 <table id="list"   style="width:100%" >
                        <thead>
                            <tr>
                                <td>Наименование</td>
                                <td>Ед.<td>
                                <td>Цена, руб.(в т.ч. НДС)</td>
                                <td>Наличие</td> 
                                <td>Количество</td>
								<td>    </td>
                            </tr>
                           
						   
                        </thead>
                        <tbody>




 
 
 
 
 
 <?
 echo '<tr>';
                               echo' <td>           </td>';
                                echo'<td>  </td>';
                                echo'<td>     </td>';
                                echo'<td>    </td>';  
                                echo' <td>   </td>';
								echo' <td>      </td>';
							    echo' <td>       </td>';
echo '</tr>'; 
 foreach($model->arrElements as $element){
	 
echo '<tr>';
                               echo' <td> '.$element['name'].'</td>';
                                echo'<td>шт</td>';
                                echo'<td>3068.00</td>';
                                echo'<td> fg</td>';  
                                echo' <td>9</td>';
								echo' <td><input  type="text">     </td>';
							    echo' <td>   <button>пересчитать</<button></td>';
echo '</tr>'; 
	
	 
};
 
 
 ?>
 

                        </tbody>
                    </table>
			 
			 	<br><br><br><br>
             <?//=print_r($model->TopArrCurSection)?>
			 
  
  
			 
			</div>

	</div>
</div>


	 <?
 //echo 'сообщение модели'.$model->message;			 
	 
//echo 'секция модели  '.$model->section;		
       //print_r($model->arrSectioons);
		
		echo '<br>';echo '<br>';echo '<br>';echo '<br>';
			
	//	print_r($model->arrElements);
		
		  echo 'TopArrCurSection   <br>';echo '<br>';echo '<br>';echo '<br>';

	 	 print_r($model->TopArrCurSection);
		
	 echo '<br>';echo '<br>';echo '<br>';echo '<br>';
        //echo'BottomArrCurSection     =<br>';
		 //print_r($model->BottomArrCurSection); 
		
		
		foreach($model->BottomArrCurSection as $k=>$v)
		{
		
		echo gettype($v).'<br>';
			
			
			
			
			//echo '<br>';
		};
		// echo '<br>';echo '<br>';echo '<br>';echo '<br>';

				// print_r($model->section);
		
		// echo '<br>';echo '<br>';echo '<br>';echo '<br>';

		  print_r($model->BottomArrCurSection);  echo '<br>';
		
		  $model->elementPerPage.' elementPerPage   ';echo '<br>';echo '<br>';   echo 'page '.$model->page;echo '<br>';echo '<br>';
		

		
		echo $model->message.' message of model';
		 //echo intval( $model->page)*$model->elementPerPage;
		 
		 
print_r($model->quantityPageForCurSection);
		
			  ?>

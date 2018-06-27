<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Каталог';
$this->params['breadcrumbs'][] = $this->title;



 
$session = Yii::$app->session;
$session->open();


/// we have to delete lasta element form  $model->TopArrCurSection   it is our top top super section
$countTopArray=count($model->TopArrCurSection);

if($countTopArray>0){
	
	unset($model->TopArrCurSection[array_search('48', $model->TopArrCurSection)]);
};

if($countTopArray>0){
	
	unset($model->TopArrCurSection[array_search($model->section, $model->TopArrCurSection)]);
};


 ///add all of top sections 
 
if(isset($model->TopArrCurSection)&&count($model->TopArrCurSection)>0){
	
	foreach($model->TopArrCurSection as $val){
	$this->params['breadcrumbs'][] =['label' =>  $model->getSectionNameById($val), 'url' => [Url::to(['catalog/index', 'section' => $val, 'element'=> 'non', 'page'=> 0,])]];
	
	};
	
};


$this->params['breadcrumbs'][] =['label' => $model->getSectionNameById($model->section), 'url' => [Url::to(['catalog/index', 'section' => $model->section, 'element'=> 'non', 'page'=> 0,])]];

  


function printSection($arrSection){
	
	 
	
	if(isset($arrSection)&&count($arrSection)>0){
		 
		echo '<ul>';
 
		
		
		foreach($arrSection as  $dataArray){
			
	
		
		      
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
			  
		
		
		          <h1 id="section_name" ><?=$model->getSectionNameById($model->section)?></h1>
					<?php
					
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
                                <td>в корзине</td> 
                                <td>добавить </td>
								<td>    </td>
                            </tr>
                           
						   
                        </thead>
                        <tbody>


 
 
 
 <?
 echo '<tr>';
                               echo' <td>           </td>';
                                echo'<td>            </td>';
                                echo'<td>            </td>';
                                echo'<td>             </td>';  
                                echo' <td>            </td>';
								echo' <td>            </td>';
							    echo' <td>             </td>';
echo '</tr>'; 
 foreach($model->arrElements as $element){
	 
echo '<tr  id ="element_row_'.$element['id'].'">';
                               echo' <td> '.$element['name'].'</td>';
                                echo'<td>шт</td>';
                                echo'<td> </td>';
                                echo'<td>100</td>';  
                                echo' <td>0  </td>';
								echo' <td  ><input  id ="input_'.$element['id'].'"   type="text"  value="1">     </td>';
							    echo' <td>    <div class="btn btn-default"  id="btn_site_addadmin"  onclick=btn_catalog_add_to_bascet('.$element['id'].') >добавить</div>

	</td>';
echo '</tr>'; 
	
	 
};
 
 
 ?>
 

                        </tbody>
                    </table>
			 
			 	<br><br><br><br>
             <?//=print_r($model->TopArrCurSection)?>
			 
  
  
			 
			</div>
              <h1 id="message_div" >сообщение модели</h1>
	</div>
</div>




<script>
function btn_catalog_add_to_bascet(data) {
    

   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
      mes( this.responseText);
    }
  };
  xhttp.open("GET", "<?=Url::to(['catalog/addtobascetajax']) ?>", true);
  xhttp.send();
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
		
		echo '<br>';echo '<br>';echo '<br>';echo '<br>';
			
	//	print_r($model->arrElements);
		
		  echo 'TopArrCurSection   <br>';echo '<br>';echo '<br>';echo '<br>';

	 	 print_r($model->TopArrCurSection);
		
	// echo '<br>';echo '<br>';echo '<br>';echo '<br>';
        //echo'BottomArrCurSection     =<br>';
		 //print_r($model->BottomArrCurSection); 
		
		
	//	foreach($model->BottomArrCurSection as $k=>$v)
	//	{
		
	//	echo gettype($v).'<br>';
			
			
			
			
			//echo '<br>';
	//	};
		// echo '<br>';echo '<br>';echo '<br>';echo '<br>';

				// print_r($model->section);
		
		// echo '<br>';echo '<br>';echo '<br>';echo '<br>';

		  print_r($model->BottomArrCurSection);  echo '<br>';
		
		//  $model->elementPerPage.' elementPerPage   ';echo '<br>';echo '<br>';   echo 'page '.$model->page;echo '<br>';echo '<br>';
		

		
		//echo $model->message.' message of model';
		 //echo intval( $model->page)*$model->elementPerPage;
		 
		 
//print_r($model->quantityPageForCurSection);
		
			  ?>

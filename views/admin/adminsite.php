<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Административный раздел';
$this->params['breadcrumbs'][] = $this->title;




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


		echo '<li t='.$qv.'>';
		echo '<a  href='.Url::to(['admin/index', 'section' => $arrSection['id'], 'element' => 'non', 'page' => 0, ]) . ' >' . $arrSection['name']. '</a>'; 

		
		 
		
			if(!$qv==0){

			echo '<ul>';

			foreach($arrSection['childArray'] as $key =>$children){printSection($children,$cursection);}

			echo '</ul>';

			}else{ if($q>0&&$arrSection['id']==$cursection){
				
				echo '<ul>';

				 
			     foreach($arrSection['childArray'] as $key =>$children){
					 
					 
					 echo '<li>';
					 echo '<a  href='.Url::to(['admin/index', 'section' => $children['id'], 'element' => 'non', 'page' => 0, ]) . ' >' . $children['name']. '</a>'; 
					 echo '</li>';
					 
				 }

			     echo '</ul>';
				
				
			}
				
				
				
				
			}
			
			
			
			
		
		echo '</li>';
	
	}
	
	
	  
	
	
	
	
	
	
	
	 
};





?>





<div class="site-catalog">
 <div class="row"> 

 <h1><?= Html::encode($this->title) ?></h1>

	</div>
	
	 <div class="row"> 
	
	

 
 
 	
 
 <div class="col-sm-4"  >
     <p>
       'Административный раздел каталог' 
    </p>
   
   
   
   	<?
		echo '<ul>';


		foreach ($catalogModel->arrSectioons as $topSection) {
			printSection($topSection,$catalogModel->section);
			echo 'df';
		};
		echo '</ul>';
		?>
   
   
   
   
 
 	</div>
 <div class="col-sm-8"  >
 
	 <h1>сообщение модели</h1>
 <h1 id="message_div" >сообщение модели</h1>
	
	<p id="btn_site_uploadenom"  > <?=$model->message;?></p> 
	
	
 

	
		<p><div class="btn btn-default"  id="btn_site_cleancache"  onclick='btn_admin_cleancache()'        >очистка кэша </div></p>
		
		
		
		
		<p><div class="btn btn-default"  id="btn_site_addadmin"  onclick='btn_admin_addadmin()'        >создать админа пользователя</div></p>

	
		 
			<p><div class="btn btn-default"  id="btn_admin_Uploadenomartist"  onclick='btn_admin_Uploadenomartist()'        >загрузить номенклатуру ходожника </div></p>
		
		
		<p><div class="btn btn-default"  id="btn_admin_Uploadequantityprice"  onclick='btn_admin_Uploadequantityprice()'        >загрузить количество цену </div></p>
		
			<p><div class="btn btn-default"  id="btn_admin_Activedeactivelemensection"  onclick='btn_admin_Activedeactivelemensection()'        >установить активнось элементов каталогов </div></p>
		
		
			<p><div class="btn btn-default"  id="btn_admin_Setimageforelementfromfile"  onclick='btn_admin_Setimageforelementfromfile()'        >установить картинки для элементов </div></p>
		
		
		
		
		
	
    <code><//?= __FILE__ ?></code>
 
 
 
 
 
 
 
 
 
 <br>
 
 
 
 
 	 <table id="list"   style="width:100%" >
                        <thead>
                            <tr>
                                <td>Наименование</td>
                                <td>Ед.</td>
                                <td>Цена, руб.(в т.ч. НДС)</td>
                                <td>цена</td> 
                                <td> в корзине</td>
								<td> добавить   </td>
								<td>    </td>
                            </tr>
                        </thead>
                        <tbody>


 
 
 
 <?
echo '<tr>';
echo ' <td>           </td>';
echo '<td>            </td>';
echo '<td>            </td>';
echo '<td>             </td>';
echo ' <td>            </td>';
echo ' <td>            </td>';
echo ' <td>             </td>';
echo '</tr>';
foreach ($catalogModel->arrElements as $element) {

	echo '<tr  id ="element_row_' . $element['id'] . '">';
	echo ' <td> ' . $element['name'] . '</td>';
	echo '<td>шт</td>';
	echo '<td>'.$element['imagep'].'</td>';
	echo '<td>100</td>';
	echo ' <td>0  </td>';
	echo ' <td  ><input  id ="input_' . $element['id'] . '"   type="text"  value="1">     </td>';
	echo ' <td>    <div class="btn btn-default"  id="btn_site_addadmin"  onclick=btn_catalog_add_to_basket(' . $element['id'] . ') >добавить</div>

	</td>';
	echo '</tr>';


};


?>
 

                        </tbody>
                    </table>
 
 
 
 
 <br>
 
 
 <? //print_r($catalogModel->arrElementsImage);  ?> 
 
   <br> <br> arrSections<br>
 <? print_r($catalogModel->arrSectioons);  ?> 
  <br> <br>  <br>
 <?// print_r($catalogModel->arrElementsPrice);  ?> 
 
 
 
    <br> <br> TopArrCurSection<br>
 <? print_r($catalogModel->TopArrCurSection);  ?> 
 
 
    <br> <br> section<br>
 <? print_r($catalogModel->section);  ?> 
 
 
 
 
 </div>
 	</div>
	
	
</div>
<script>
 
 

function btn_admin_cleancache() {
    

   var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
      mes( this.responseText);
    }
  };
  xhttp.open("GET", "<?=Url::to(['admin/cleancache']) ?>", true);
  xhttp.send();

 console.log("секции ")
}


function btn_admin_addadmin() {
    

   var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
      mes( this.responseText);
    }
  };
  xhttp.open("GET", "<?=Url::to(['admin/addadmin']) ?>", true);
  xhttp.send();

 console.log("начало ")
}


function btn_admin_Uploadenomartist() {
    

   var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
      mes( this.responseText);
    }
  };
  xhttp.open("GET", "<?=Url::to(['admin/uploadenomartist']) ?>", true);
  xhttp.send();

 console.log("начало ")
}


function btn_admin_Uploadequantityprice() {
    

   var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
      mes( this.responseText);
    }
  };
  xhttp.open("GET", "<?=Url::to(['admin/uploadequantityprice']) ?>", true);
  xhttp.send();

 console.log("секции ")
}


function btn_admin_Activedeactivelemensection() {
    

   var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
      mes( this.responseText);
    }
  };
  xhttp.open("GET", "<?=Url::to(['admin/activedeactivelemensection']) ?>", true);
  xhttp.send();

 console.log("секции ")
}


function btn_admin_Setimageforelementfromfile() {
    

   var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
      mes( this.responseText);
    }
  };
  xhttp.open("GET", "<?=Url::to(['admin/setimageforelementfromfile']) ?>", true);
  xhttp.send();

 console.log("секции ")
}






function mes(mes){
	mes_div= document.getElementById('message_div').innerHTML=mes;
	
	
}

</script>
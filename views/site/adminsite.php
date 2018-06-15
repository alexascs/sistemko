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
 
 <h1 id="message_div" >сообщение модели</h1>
	
	<p id="btn_site_uploadenom"  > <?=$model->message;?></p> 
	
	
	<p><div class="btn btn-default"  id="btn_site_uploadenom"  onclick='btn_site_uploadenom()'        >Загрузить Номенклатуры из csv на сайте  </div></p>

	
	<p><div class="btn btn-default"  id="btn_site_makesection"  onclick='btn_site_makesection()'        >создать секции  </div></p>

	
	
	
    <code><//?= __FILE__ ?></code>
</div>
<script>
function btn_site_uploadenom() {
    

   var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
      mes( this.responseText);
    }
  };
  xhttp.open("GET", "<?=Url::to(['site/uploadenom']) ?>", true);
  xhttp.send();

 console.log("начало ")
}


function btn_site_makesection() {
    

   var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
      mes( this.responseText);
    }
  };
  xhttp.open("GET", "<?=Url::to(['site/makesection']) ?>", true);
  xhttp.send();

 console.log("секции ")
}




function mes(mes){
	mes_div= document.getElementById('message_div').innerHTML=mes;
	
	
}

</script>
<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\CatalogModel;
use app\models\AjaxModel;


  

class CatalogController extends Controller
{
      
	 public $defaultAction = 'index';
	
	
	
    public function actionIndex()
    {
		$model=new CatalogModel();
		//$model->scenario = 'default';
		 $model->elementPerPage=50;
		 $model->quantityPageForCurSection;
		 
		$model->load(Yii::$app->request->get(),'');
		
		//main array of sections   
	    $model->fillarrSectioons();
		
		
		//top section for curient sectio
		$model->fillTopArrCurSection(); 
	   
	   $model->fillBottomArrCurSection();
		$model->fillQuantitypageforqurientsection();
		   
	    $model->fillarrElements();
			
			
			
			
		   return $this->render('catalog', [
         'model' => $model,
			]);
			
    }
 
	 
	    public function actionAddtobascetajax()
    { 
			$this->layout = 'ajaxl';
		    $model=new AjaxModel();
		   $model->message='addtobascetajax';
		   
		   return $this->render('catalogajax', [
           'model' => $model,
			]);
			
    }
	
	
	
 
	
 
	
	
}

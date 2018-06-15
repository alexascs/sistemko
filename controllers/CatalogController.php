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
		
		 
		$model->load(Yii::$app->request->get(),'');
		
	    $model->fillarrSectioons();
		   
	    $model->fillarrElements();
			
			
			
			
		   return $this->render('catalog', [
         'model' => $model,
			]);
			
    }
 
	 
	
	
	
	
 
	
 
	
	
}

<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CatalogModel extends Model
{
    public $section;
    public $element;
    public $pagen;
	
	//private $arrElements; 
    //private $arrSectioons;
    ///private $arrPages;

   
    public function rules()
    {
        return [
       
          
		      [['title', 'element', 'pagen'], 'safe'],
		  
		  
		  
        ];
    }
	
	
	
	
	
			public function scenarios()
	{
			$scenarios['default'] = ['section', 'element', 'pagen'];
			
			return $scenarios;
	}
	

 
 
 
 
 
}

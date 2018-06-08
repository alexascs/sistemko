<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Element;

/**
 * ContactForm is the model behind the contact form.
 */
class AdminModel extends Model
{
    public $message;
	
    


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
           // [['section', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['message'],
            // verifyCode needs to be entered correctly
           // ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
     public function attributeLabels()
     {
         return [
             'message' => 'Verification Code',
         ];
     }

    
	private function procceccArrayOfStingFromFile($ar){
		
		
		
		$element = Element::find()
    ->where(['code' =>ltrim($ar[1])])
    ->one();
	
	if(!$element){
		
		$el=new Element();
		   $el->name= ltrim($ar[0]);
			 $el->code=ltrim($ar[1]);
			 $el->xmlcode="";
			 $el->active=ltrim($ar[3]);
			 $el->idp =ltrim($ar[5]);
			 $el->quantity ='0';
			 $el->issection =ltrim($ar[3]);
			 $el->index1 ="";
			 $el->index2 ="";
			 $el->active ="";
		$el->save();
		
		
	};
		
		
	}
	
	
	 public function Uploadenom()
     {
        // $fp = fopen( __dir__.'/counter.txt', 'w');
		 // $mes=$_SERVER['DOCUMENT_ROOT'];
					  $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/upload/1c_catalog/1csvgooood.csv', "r"); // Открываем файл в режиме чтения
					
					
					$count=0;
					

					 if ($fp) 
					  {
						 while (!feof($fp))
						 {     // $count=$count+1; if($count==20){break;};
						 $mytext = fgets($fp, 999);
						 
						 $ar=str_getcsv ($mytext,";");
						 
						 $this->procceccArrayOfStingFromFile($ar);
						 
						  //$inc=0;
						  //$imes='';
						 // foreach(   $ar  as $t=>$r ){  $mes=$mes.'  '.$r.'  '.' = '.$t.' ';     };
						 
						 
						 //$mes=$mes.$imes."<br />";
						 }
					   }
					  else $mes="Ошибка при открытии файла";
					  fclose($fp);
		 
		 
		 
		 
		 $this->message= $mes;
		 
		 
		 
		 
     }
	
     
}

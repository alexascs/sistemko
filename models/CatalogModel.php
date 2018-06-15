<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\caching\Cache;


/**
 * ContactForm is the model behind the contact form.
 */
class CatalogModel extends Model
{   
    
	
	public $elementPerPage;
	public $quantityElementInTable;
	
    public $message;
	
    public  $section;
    public  $element;
    public  $pagen;
	
	public $sa;////
	
	private $id_tovar;///the main   grup  tovar;
	
	private $tableSections;
	private $tableElements;
	
	
	public   $arrElements; 
    public    $arrSectioons;
	public   $arrSectioonsCurSection; // we need iit for quick  select elemet from element table 
	
    public  $arrPages;

   
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
	
       ///data for view arrSectioons  
		  public function fillarrSectioons()
			{ $mes='<br>fillarrSectioons  <br>';
				 
				
					$this->arrSectioons = Yii::$app->cache->get("arrSectioons");
			           $mes=$mes.' array'.$this->arrSectioons.' <br> ';

						if ($this->arrSectioons === false) {
						
						$this->id_tovar=$this->findeSectionByCode('00000000001');
						
						$mes=$mes."00000000001 al = id ".$this->id_tovar.'<br>';
			
						
						//$starArray=$this->getStartArrayForSections($this->id_tovar);
                             
						   $treeArray=array();
						   
						   $treeArray[$this->id_tovar]= $this->makeTreeForSection ($this->id_tovar);
						 
						   
						    
						  Yii::$app->cache->set('arrSectioons', $treeArray);
				        }
				
				
				$this->message=$this->message.$mes;
				
			}
			
			
            ///data for view arrElements 
		   public function fillarrElements()
			{ 
				 //we need element only for our group
				 
				 
				//finde all chaild of id.
		         $sections = Element::find()
				 ->orderBy("name")
				 //->where(['idp' =>ltrim(  $startCode )])
				 ->all();
				
				
				
				
				
			}
 
          
        public  function  makeTreeForSection ($startCode)
		 { 
		  
		        
				$inArray=Array();
				
				
				 //finde all chaild of id.
		         $sections = Section::find()
				 ->where(['idp' =>ltrim(  $startCode )])
				 ->all();
				 
				  
		 
		                if(!$sections) {return;};
		 
					    foreach($sections  as  $section ){							 

						$inArray[ $section->id]=$this->makeTreeForSection($section->id);
                             
						$this->message=$this->message.$section->id.'<br>';
								 
						  
					    };
		 
		 
	 
			 
			
			
			return $inArray;
			
		 }
 
 
 
			public function findeSectionByCode($code){
				
				$mes="<br>findeSectionByCode    code =".$code.'  <br>   ';
				
				$rez=false;
				
				
				$section = Section::find()
                  ->where(['code' =>$code ])
                  ->one();
				
				
				if(isset($section)){
					$mes=$mes.'    finde id  <br>';
					$rez=$section->id;
					
					
					
					
				}else { $mes=$mes.'    on finde  id  <br>';    };
				
				 $mes=$mes.' rez='.$rez.'  <br>';
				
				$this->message=$this->message.$mes;
				
				return $rez;
			}
 
 
}

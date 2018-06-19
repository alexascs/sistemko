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
	 
	public  $quantityPageForCurSection;
	
    public $message;
	
    public  $section;
    public  $element;
    public  $page;
	
 
	
	private $id_tovar;///the main   grup  tovar;
	
	//private $tableSections;
	//private $tableElements;
	
	
	public   $arrElements; 
    public   $arrSectioons;
	public   $TopArrCurSection; // we need for every request fo curient section
	public   $BottomArrCurSection; 
	//public   $BottomArrCurSectionArr;
	
	
    public  $arrPages;

   
    public function rules()
    {
        return [
       
          
		      [['title', 'element', 'page'], 'safe'],
		  
		  
		  
        ];
    }
	
	
	
	
	
			public function scenarios()
	{
			$scenarios['default'] = ['section', 'element', 'page'];
			
			return $scenarios;
	}
	
       ///data for view arrSectioons  
		  public function fillarrSectioons()
			{ //$mes='<br>fillarrSectioons  <br>';
				 
				 
					$this->arrSectioons = Yii::$app->cache->get("arrSectioons");
			          // $mes=$mes.' array'.$this->arrSectioons.' <br> ';

						if ($this->arrSectioons === false) {
						
						$this->id_tovar=$this->findeSectionByCode('00000000001');
						
						$mes=$mes."00000000001 al = id ".$this->id_tovar.'<br>';
			
						
						;
                             
						 
						 
						   
						   $treeArray=$this->makeTreeForSection ($this->id_tovar);
						 
						   $this->arrSectioons=$treeArray;
						    
							//print_r( $treeArray); 
							
						  //Yii::$app->cache->set('arrSectioons', $treeArray);
				        }
				
				
				//$this->message=$this->message.$mes;
				
			}
			
			
			
			
			
            ///data for view arrElements 
		   public function fillarrElements()
			{ $this->arrElements=[];
				 //we need element only for our group
				 
				 $this->BottomArrCurSection[]=intval((trim($this->section)));
				// $rt=intval((trim($this->section)));
				 $mainArray=Array();
				 //$mainArray[]=0;
				// $mainArray[]=19;
				 
				// echo gettype(BottomArrCurSection[0]) ;
				//  echo gettype(BottomArrCurSection[1]) ;
				 	 //echo gettype( $rt) ;
				 
				 
				//finde all chaild of id.
		         $elements = Element::find()
				  ->where(['idp' =>$this->BottomArrCurSection ,'issection' =>false]) 
				 ->orderBy("name")				
				 ->offset( intval( $this->page*$this->elementPerPage))
				  //->limit(intval($this->elementPerPage))
				 //->where(['idp' =>ltrim(  $startCode )])
				 ->all();
				
				
				//print_r($this->BottomArrCurSection);        
				
				
				
				foreach($elements as $element){
					$idArray=Array();
							//echo $element->id;
						
                         //we do not make the tree in this function
						// echo 'ffff <br>';
						$idArray[ 'id']= $element->id;
						$idArray[ 'name']= $element->name;
						$idArray[ 'index1']= $element->index1;
						$idArray[ 'index2']= $element->index2;
						$idArray[ 'idp']= $element->idp;
						//$idArray[ 'childArray']= '';  ///$this->makeTreeForSection($section->id);
						$this->arrElements[]=$idArray;
				};
				
			
			
				
			}
 
         
		  
		  
		  
		  
		  
        public  function  makeTreeForSection ($startCode)
		 {      // $mes='<br>fillarrSectioons  <br>';
		  
		        
				$childArray=Array();
				$mainArray=Array();
				
				 //finde all chaild of id.
		         $sections = Section::find()
				 ->where(['idp' =>ltrim(  $startCode )])
				 ->all();
				 
				  
		 
		                if(!$sections) {return;};
		 
					    foreach($sections  as  $section ){
							///id array;
							$idArray=Array();
							
						

						$idArray[ 'id']= $section->id;
						$idArray[ 'name']= $section->name;
						$idArray[ 'index1']= $section->index1;
						$idArray[ 'index2']= $section->index2;
						$idArray[ 'idp']= $section->idp;
						$idArray[ 'childArray']= $this->makeTreeForSection($section->id);
						
						$mainArray[]=$idArray;
                             
						$this->message=$this->message.$section->id.'<br>';
								 
						  
					    };
		 
		 
	 
			 $childArray[$startCode]=$mainArray;
			
			
			return $childArray;
			
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
 
 
 
 
 
 
 
			public function fillTopArrCurSection(){
				
				///make  key for the section
				if (!isset($this->section)){$this->section=$this->id_tovar;};
				$key="top_section_".$this->section;
				
				
				$this->TopArrCurSection = Yii::$app->cache->get($key);
			          
             
						if ($this->TopArrCurSection === false) {
						
									 
									
									$this->getParentsForSection($this->section);
									
								
								
									   
									//$this->TopArrCurSection=$inArray;

									//Yii::$app->cache->set($key, $treeArray);
				        }
				
				
				
				
			}
 
             public function getParentsForSection($sectionId){
				 
				 
				 
				//$inArray=Array();
				 //it is curient section if we have the id we have the section
				// if(isset($sectionId)){  };
				 
				 $this->TopArrCurSection[]=intval($sectionId) ;
				//echo($sectionId );
				  return;
				 
				  $section = Section::find()
                  ->where(['id' =>$sectionId ])
                  ->one();
				  
				 if(!$section){return;};
				  
				  $this->TopArrCurSection[]=$sectionId ;
				  
			       $this->getParentsForSection($section->idp);
				 
				 
				// return $inArray; 
				 
				 
				 
			 }


		   public function fillBottomArrCurSection()
		   
		   {	///make  key for the section
				
				$key="botton_section_".$this->section;
				
				 
				$this->BottomArrCurSection = Yii::$app->cache->get($key);
			      

						if ($this->BottomArrCurSection === false) {
						
									
									
									
									

									
                                       $this->getChildrenForSection($this->section);
									   
									   
									//$this->BottomArrCurSection=$inArray;

									//Yii::$app->cache->set($key, $treeArray);
				        }
				
				
			   
			   
			   
			   
			   
			   
		   }
		   
  public function  getChildrenForSection($sectionId){
   
   	 	//$this->BottomArrCurSection[]=$section->id;
				 //it is curient section if we have the id we have the section
				 
				 //$childArray=Array();
				$this->BottomArrCurSection[]=intval($section->id);
				 
				  $sections = Section::find()
                  ->where(['idp' =>$sectionId ])
                  ->all();
				  
				 if(!$sections){return;};
				  
				foreach($sections as $section ){
					 //$inArray=Array();
					// $inArray['id']=[$section->id];
					// $inArray['idchildren']=$this->getChildrenForSection($section->id);
					
					//$childArray[]= $inArray;
					
					$this->BottomArrCurSection[]=intval($section->id);
					$this->getChildrenForSection($section->id);
					
				};
				  
				  
				 
				 
				 return $childArray;
				 
				 
				 
			 }
   
   
  
  
 
     
	 

	  
	  
	  
	 
 public function fillQuantitypageforqurientsection(){
	

               $count = Element::find()//->where(['idp' =>$this->BottomArrCurSection  ])->count();
               ->where(['idp' =>$this->BottomArrCurSection ,'issection' =>false]) 
				// ->orderBy("name")				
				 //->offset(100)
				 // ->limit($this->elementPerPage)
				 //->where(['idp' =>ltrim(  $startCode )])
			
         ->count();
		 
		   $this->message='quantitq = '.$count.'quantitq = ';
		   if(!$count){
			   
			   $this->quantityPageForCurSection=0;
		   }else{  $this->quantityPageForCurSection = ceil( $count/$this->elementPerPage);};
			   
	
	 //$this->quantityPageForCurSection= ceil(  $count/$this->elementPerPage);

	 //$this->quantityPageForCurSection= ceil(  $count/intval($this->elementPerPage));
	 
	 
 }
  



}

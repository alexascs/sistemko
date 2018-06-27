<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\CatalogModel;
use app\models\AjaxModel;
use app\models\BitrixModel;

  

class BitrixController  extends Controller
{
      
	 public $defaultAction = 'index';
	
	
	
    public function actionIndex()
    {
		$model=new BitrixModel();
	    $this->layout = 'ajaxl';
			
			$model->message='sucsses';
		   return $this->render('bitrix', [
         'model' => $model,
			]);
			
    }
 
	  
	///1c_ex
 
	  public function actionBitrix()
    {
		
		
		
		$model=new BitrixModel();
	    $this->layout = 'ajaxl';
			
			
			
			
			$g=Yii::$app->request->get();
			
			
			
			if(isset($g)&&$g['type']=='sale'&& $g['mode']=="init"){
				
				$model->message='zip=no'."<br>".'file_limit=64000';
				
				
			};
			
				if(isset($g)&&$g['type']=='sale'&& $g['mode']=="checkauth"){
				
				$model->message='success';
				
				
			};
			
			
				if(isset($g)&&$g['type']=='sale'&& $g['mode']=="success"){
				
				$model->message='success';
				
				
			};
			
			
			if(isset($g)&&$g['type']=='sale'&& $g['mode']=="query"){
				
				$model->message='<?xml version="1.0" encoding="windows-1251"?>
		<КоммерческаяИнформация ВерсияСхемы="2.03" ДатаФормирования="2018-06-26">
					<Документ>
				<Ид>21</Ид>
				<Номер>21</Номер>
				<Дата>2018-06-26</Дата>
				<ХозОперация>Заказ товара</ХозОперация>
				<Роль>Продавец</Роль>
				<Валюта>RUB</Валюта>
				<Курс>1</Курс>
				<Сумма>9683.42</Сумма>
				<Контрагенты>
					<Контрагент>
						<Ид>1#admin#Петров Петр </Ид>
						<Наименование>Петр Петров</Наименование>
						<Роль>Покупатель</Роль>
														<ПолноеНаименование>Петр Петров</ПолноеНаименование>
								<Фамилия>Петров</Фамилия><Имя>Петр</Имя>								<АдресРегистрации>
									<Представление>87698</Представление><АдресноеПоле>
										<Тип>Почтовый индекс</Тип>
										<Значение>6546</Значение>
									</АдресноеПоле><АдресноеПоле>
										<Тип>Улица</Тип>
										<Значение>87698</Значение>
									</АдресноеПоле>								</АдресРегистрации>
														<Контакты>
															</Контакты>
														<Представители>
								<Представитель>
									<Контрагент>
										<Отношение>Контактное лицо</Отношение>
										<Ид>ab7399a8aa62c20e0e9f3ea53c6dac81</Ид>
										<Наименование>Петр Петров</Наименование>
									</Контрагент>
								</Представитель>
							</Представители>
													
					</Контрагент>
				</Контрагенты>
				
				<Время>15:40:40</Время>
				<Комментарий></Комментарий>
												<Товары>                              
									<Товар>
						<Ид>ORDER_DELIVERY</Ид>
						<Наименование>Доставка заказа</Наименование>
						<БазоваяЕдиница Код="796" НаименованиеПолное="Штука" МеждународноеСокращение="PCE">шт</БазоваяЕдиница>
						<ЦенаЗаЕдиницу>348.00</ЦенаЗаЕдиницу>
						<Количество>1</Количество>
						<Сумма>348.00</Сумма>
						<ЗначенияРеквизитов>
							<ЗначениеРеквизита>
								<Наименование>ВидНоменклатуры</Наименование>
								<Значение>Услуга</Значение>
							</ЗначениеРеквизита>
							<ЗначениеРеквизита>
								<Наименование>ТипНоменклатуры</Наименование>
								<Значение>Услуга</Значение>
							</ЗначениеРеквизита>
						</ЗначенияРеквизитов>
					</Товар>
										<Товар>
						<Ид>cbcf498f-55bc-11d9-848a-00112f43529a</Ид>
						<ИдКаталога>bd72d8f9-55bc-11d9-848a-00112f43529a</ИдКаталога>
						<Наименование>Комбайн MOULINEX  A77 4C</Наименование>
						<БазоваяЕдиница Код="796" НаименованиеПолное="Штука" МеждународноеСокращение="PCE">шт</БазоваяЕдиница>
												<ЦенаЗаЕдиницу>9335.42</ЦенаЗаЕдиницу>
						<Количество>1.00</Количество>
						<Сумма>9335.42</Сумма>
												<ЗначенияРеквизитов>
							<ЗначениеРеквизита>
								<Наименование>ВидНоменклатуры</Наименование>
								<Значение>Товар</Значение>
							</ЗначениеРеквизита>
							<ЗначениеРеквизита>
								<Наименование>ТипНоменклатуры</Наименование>
								<Значение>Товар</Значение>
							</ЗначениеРеквизита>
						</ЗначенияРеквизитов>
					</Товар>
									</Товары>
				<ЗначенияРеквизитов>
											<ЗначениеРеквизита>
							<Наименование>Дата оплаты</Наименование>
							<Значение>2007-10-16 15:44:47</Значение>
						</ЗначениеРеквизита>
												<ЗначениеРеквизита>
							<Наименование>Номер платежного документа</Наименование>
							<Значение>ТК000000026</Значение>
						</ЗначениеРеквизита>
												<ЗначениеРеквизита>
							<Наименование>Метод оплаты</Наименование>
							<Значение>Наличный расчет</Значение>
						</ЗначениеРеквизита>
												<ЗначениеРеквизита>
							<Наименование>Дата разрешения доставки</Наименование>
							<Значение>2007-10-16 15:51:27</Значение>
						</ЗначениеРеквизита>
											<ЗначениеРеквизита>
						<Наименование>Заказ оплачен</Наименование>
						<Значение>true</Значение>
					</ЗначениеРеквизита>
					<ЗначениеРеквизита>
						<Наименование>Доставка разрешена</Наименование>
						<Значение>true</Значение>
					</ЗначениеРеквизита>
					<ЗначениеРеквизита>
						<Наименование>Отменен</Наименование>
						<Значение>false</Значение>
					</ЗначениеРеквизита>
					<ЗначениеРеквизита>
						<Наименование>Финальный статус</Наименование>
						<Значение>true</Значение>
					</ЗначениеРеквизита>
					<ЗначениеРеквизита>
						<Наименование>Статус заказа</Наименование>
						<Значение>[F] Доставлен</Значение>
					</ЗначениеРеквизита>
											<ЗначениеРеквизита>
							<Наименование>Дата изменения статуса</Наименование>
							<Значение>2007-10-16 15:51:58</Значение>
						</ЗначениеРеквизита>
										</ЗначенияРеквизитов>
			</Документ>
					</КоммерческаяИнформация>';
				
			};
			
			
		   return $this->render('bitrix', [
         'model' => $model,
			]);
			
    }
 
	
	
}
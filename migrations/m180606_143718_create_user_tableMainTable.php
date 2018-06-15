<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m180606_143718_create_user_tableMainTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {    $tableOptions = null;
	
	
         $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
			'phone' => $this->string(),
			'adress' => $this->string(),
			
        ], $tableOptions);
		
		
		
		
		
		  $this->createTable('section', [
           'id' => $this->primaryKey(),
			'name'=> $this->string(),
			'code'=> $this->string(),
			'xmlcode'=> $this->string(),
			'active'=> $this->string(),
			'codep' => $this->string(),
			'idp' => $this->string(),
			 
			'issection' => $this->string(),
			'index1' => $this->string(),
			'index2' => $this->string(),
			'active' => $this->string(),
			
			
        ]);
		
		
		  $this->createTable('element', [
            'id' => $this->primaryKey(),
			'name'=> $this->string(),
			'code'=> $this->string(),
			'xmlcode'=> $this->string(),
			'active'=> $this->string(),
			'codep' => $this->string(),
			'idp' => $this->string(),
			'quantity' => $this->string(),
			'issection' => $this->string(),
			'index1' => $this->string(),
			'index2' => $this->string(),
			'active' => $this->string(),
			
        ]);
		
		
		 $this->createTable('price', [
            'id' => $this->primaryKey(),
			'elementid'=> $this->string(),			 
			'price'=> $this->string(),
			 
			]);
		
		 
		
		
		
		
		
		  $this->createTable('bascet', [
            
			'id' => $this->primaryKey(),
			'userid'=> $this->string(),
			'elementid'=> $this->string(),
			'price'=> $this->string(),
			'sum'=> $this->string(),
			'quantity'=> $this->string(),
			'zakazid'=> $this->string(),
			'order'=> $this->boolean(), 
			
			
        ]);
		
		
		
			  $this->createTable('zakaz', [
            
			'id' => $this->primaryKey(),
			'userid'=> $this->string(),
			 'summ'=> $this->string(),
			 
			
			
        ]);
		
		
		
		
		
			  $this->createTable('cache', [
            
			'id' =>$this->char(128)->notNull(),//'id' =>$this->char(128)->primaryKey()->notNull(), 
			'expire'=> $this->integer(11),
			 'data'=> $this->binary(429496729),
			 
			 
			
        ]);
		
		
				// $this->alterColumn(
			   // 'cache',
				// 'id',
				// 'PRIMARY KEY'
				// );
		
		///'NOT NULL AUTO_INCREMENT PRIMARY KEY'
		
		
		
		Yii::$app->db->createCommand('ALTER TABLE cache  ADD PRIMARY KEY(id)')
       ->queryScalar();
		
		//this->execute("ALTER TABLE cache  ADD PRIMARY KEY(id)");
		
		
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
		 $this->dropTable('section');
		  $this->dropTable('element');		 
		 $this->dropTable('zakaz');
		 	 $this->dropTable('bascet');
		 
    }
}

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
        ], $tableOptions);
		
		
		
		
		
		  $this->createTable('section', [
            'id' => $this->primaryKey(),
			'name'=> $this->string(),
			'xmlcode'=> $this->string(),
			'active'=> $this->string(),
			
			
        ]);
		
		
		  $this->createTable('element', [
            'id' => $this->primaryKey(),
			'name'=> $this->string(),
			'xmlcode'=> $this->string(),
			'active'=> $this->string(),
			
			
        ]);
		
		
		
		
		
		
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
		 $this->dropTable('section');
		  $this->dropTable('element');
		 
		
    }
}

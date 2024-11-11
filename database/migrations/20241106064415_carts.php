<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Carts extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('carts');
        $table->addColumn('user_id', 'integer', ['signed' => false, 'null' => false])  
              ->addColumn('sku_id', 'integer', ['signed' => false, 'null' => false])  
              ->addColumn('quantity', 'integer', ['signed' => false, 'default' => 1, 'null' => false]);
    
        // Adding foreign keys
        $table->addForeignKey('user_id', 'users', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION'
        ]);

        $table->addForeignKey('sku_id', 'product_skus', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION'
        ]);
    
        $table->create();
    }
    
}

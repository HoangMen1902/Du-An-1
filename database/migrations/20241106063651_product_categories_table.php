<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ProductCategoriesTable extends AbstractMigration
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
        $table = $this->table('product_categories');
        $table->addColumn('category_values_id', 'integer',['signed' => false]) 
              ->addColumn('product_id', 'integer',['signed' => false]) 
              ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->addColumn('updated_at', 'timestamp', [
                  'default' => 'CURRENT_TIMESTAMP',
                  'update' => 'CURRENT_TIMESTAMP'
              ])
              ->addForeignKey('product_id', 'Products', 'id', [
                'delete' => 'CASCADE', 
                'update' => 'NO_ACTION' 
            ])
            ->addForeignKey('category_values_id', 'category_values', 'id', [
                'delete' => 'CASCADE', 
                'update' => 'NO_ACTION' 
            ])
              ->create();
    }
}

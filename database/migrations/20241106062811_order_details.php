<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class OrderDetails extends AbstractMigration
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
        $table = $this->table('order_details');

        $table->addColumn('order_id', 'integer', ['signed' => false, 'null' => false] )
            ->addColumn('sku_id', 'integer',  ['signed' => false, 'null' => false])
            ->addColumn('price', 'decimal', ['precision' => 10, 'scale' => 2])
            ->addColumn('quantity', 'integer', ['signed' => false])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP'
            ])
            ->addForeignKey('order_id', 'orders', 'id', [
                'delete' => 'CASCADE', 
                'update' => 'NO_ACTION'
            ])    ->addForeignKey('sku_id', 'product_skus', 'id', [
                'delete' => 'CASCADE', 
                'update' => 'NO_ACTION'
            ])
            ->create();
    }
}

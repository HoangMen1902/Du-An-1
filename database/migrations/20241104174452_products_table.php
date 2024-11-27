<?php

declare(strict_types=1);

use Phinx\Db\Adapter\MysqlAdapter;

use Phinx\Migration\AbstractMigration;

final class ProductsTable extends AbstractMigration
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
        $table = $this->table('products');
        $table->addColumn('name', 'string', ['limit' => 255])
              ->addColumn('description', 'text')
              ->addColumn('short_description', 'text')
              ->addColumn('total_quantity', 'integer', ['default' => 0])
              ->addColumn('discount', 'decimal', ['precision' => 5, 'scale' => 2, 'default' => 0.00])
              ->addColumn('thumbnail', 'text')
              ->addColumn('specifications', 'text')
              ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'default' => 1])
              ->addColumn('brand_id', 'integer',['null' => true, 'signed' => false])
              ->addForeignKey('brand_id','brands','id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
              ])
              ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->addColumn('updated_at', 'timestamp', [
                  'default' => 'CURRENT_TIMESTAMP',
                  'update' => 'CURRENT_TIMESTAMP'
              ])
              ->create();
    }
}

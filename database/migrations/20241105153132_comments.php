<?php

declare(strict_types=1);

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;


final class Comments extends AbstractMigration
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
    $table = $this->table('Comments');
    $table->addColumn('content', 'text');
    $table->addColumn('rating_id', 'integer', ['signed' => false]);
    $table->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'default' => 1]);
    $table->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP']);
    $table->addColumn('product_id', 'integer', ['null' => false, 'signed' => false]);
    $table->addColumn('parent_id', 'integer', ['null' => true]);
    $table->addColumn('user_id', 'integer', ['null' => false, 'signed' => false]);

    $table->addForeignKey('product_id', 'products', 'id', [
        'delete' => 'CASCADE',
        'update' => 'NO_ACTION'
    ]);
    $table->addForeignKey('user_id', 'users', 'id', [
        'delete' => 'CASCADE',
        'update' => 'NO_ACTION'
    ]);

    $table->create();
}
}

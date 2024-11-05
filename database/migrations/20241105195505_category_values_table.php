<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CategoryValuesTable extends AbstractMigration
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
        $table = $this->table('Category_values');
        $table->addColumn('name', 'string', ['limit' => 255]);
        $table->addColumn('category_id', 'integer', ['null' => false]);
        $table->addColumn('status', 'integer', ['default' => 1]);
        $table->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP']);
        $table->addColumn('updated_at', 'timestamp', ['null' => true]);
    }
}

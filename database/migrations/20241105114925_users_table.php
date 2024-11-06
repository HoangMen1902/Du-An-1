<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UsersTable extends AbstractMigration
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
        $table = $this->table('Users');
        $table->addColumn('email', 'string', ['limit' => 254]);
        $table->addColumn('phone', 'string', ['limit' => 10]);
        $table->addColumn('password', 'string', ['limit' => 101]);
        $table->addColumn('address', 'string', ['limit' => 255]);
        $table->addColumn('firstname', 'string', ['limit' => 100]);
        $table->addColumn('lastName', 'string', ['limit' => 100]);
        $table->addColumn('username', 'string', ['limit' => 50]);
        $table->addColumn('reset_token', 'string', ['limit' => 64]);
        $table->addColumn('reset_token_expires', 'datetime');
        $table->addColumn('province_id', 'integer', ['null' => true]);
        $table->addColumn('district_id', 'integer', ['null' => true]);
        $table->addColumn('ward_id', 'integer', ['null' => true]);
        $table->addColumn('status', 'integer', ['default' => 1]);
        $table->addColumn('role', 'integer', ['default' => 1]);
        $table->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP']);
        $table->addColumn('updated_at', 'datetime');
        $table->create();

    }
}

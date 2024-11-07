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
    public function up(): void
    {
        $table = $this->table('Users');
        $table->addColumn('email', 'string', ['limit' => 255])
            ->addColumn('phone', 'string', ['limit' => 10])
            ->addColumn('password', 'string', ['limit' => 101])
            ->addColumn('address', 'string', ['limit' => 255])
            ->addColumn('firstname', 'string', ['limit' => 100])
            ->addColumn('lastName', 'string', ['limit' => 100])
            ->addColumn('username', 'string', ['limit' => 50])
            ->addColumn('reset_token', 'string', ['limit' => 64])
            ->addColumn('reset_token_expires', 'datetime')
            ->addColumn('province_id', 'integer', ['null' => true, 'signed' => false])
            ->addColumn('district_id', 'integer', ['null' => true, 'signed' => false])
            ->addColumn('ward_id', 'integer', ['null' => true, 'signed' => false])
            ->addColumn('status', 'integer', ['default' => 1])
            ->addColumn('role', 'integer', ['default' => 1])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP'
            ])->addForeignKey('province_id', 'provinces', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('district_id', 'districts', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('ward_id', 'wards', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();
    }


}

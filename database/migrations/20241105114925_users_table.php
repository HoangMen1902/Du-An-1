<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

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
        $table->addColumn('email', 'string', ['limit' => 320])
            ->addColumn('phone', 'string', ['limit' => 10])
            ->addColumn('password', 'string', ['limit' => 101])
            ->addColumn('fullname', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('firstname', 'string', ['limit' => 100])
            ->addColumn('lastname', 'string', ['limit' => 100])
            ->addColumn('reset_token', 'string', ['limit' => 64])
            ->addColumn('reset_token_expires', 'datetime')
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'default' => 1])
            ->addColumn('role', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'default' => 1])
            ->addColumn('avatar', 'text')
            ->addColumn('google_id', 'string', ['limit' => 50, 'null' => true])
            ->addColumn('facebook_id', 'string', ['limit' => 50, 'null' => true])
            ->addColumn('method', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP'
            ])
            ->create();
    }


}
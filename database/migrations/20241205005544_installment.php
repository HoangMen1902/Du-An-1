<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Installment extends AbstractMigration
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
        $table = $this->table('Installment_plans');
        $table->addColumn('order_id', 'integer', ['null' => false, 'signed' => false]) // ID đơn hàng
            ->addColumn('term', 'integer', ['null' => false]) // Thời gian trả (số tháng)
            ->addColumn('interest_rate', 'decimal', ['precision' => 5, 'scale' => 2, 'null' => false]) // Lãi suất (%)
            ->addColumn('down_payment_rate', 'decimal', ['precision' => 5, 'scale' => 2, 'null' => false]) // Trả trước bao nhiêu %
            ->addColumn('monthly_payment', 'decimal', ['precision' => 10, 'scale' => 2, 'null' => false]) // Góp mỗi tháng
            ->addColumn('end_date', 'date', ['null' => false]) // Ngày kết thúc trả góp
            ->addColumn('status', 'tinyinteger', ['default' => 1, 'null' => false]) // 1: Đang trả góp, 0: Hoàn thành
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP'
            ]
            )->addForeignKey('order_id', 'orders', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->create();
    }
}

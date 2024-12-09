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
        $table = $this->table('Installments');

        $table->addColumn('sku_id', 'integer', ['null' => false, 'signed' => false]) // Khóa ngoại đến bảng SKU
            ->addColumn('term', 'integer', ['null' => false]) 
            ->addColumn('interest_rate', 'decimal', ['precision' => 5, 'scale' => 2, 'null' => false]) 
            ->addColumn('down_payment_rate', 'text') 
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP'
            ]) // Thời gian cập nhật
            ->addForeignKey('sku_id', 'Product_skus', 'ID', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ]) // Khóa ngoại liên kết với bảng Product_skus
            ->create();
    }
}

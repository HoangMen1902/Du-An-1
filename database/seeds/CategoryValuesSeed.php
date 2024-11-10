<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class CategoryValuesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
    $categories = $this->fetchAll("SELECT id, name FROM categories WHERE name IN ('Điện Thoại', 'Laptop', 'Chuột')");

    $data = [];

    foreach ($categories as $category) {
        if ($category['name'] == 'Điện Thoại') {
            $data[] = ['name' => 'SamSung', 'status' => 1, 'category_id' => $category['id'], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
            $data[] = ['name' => 'Apple', 'status' => 1, 'category_id' => $category['id'], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
            $data[] = ['name' => 'Xiaomi', 'status' => 1, 'category_id' => $category['id'], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];

        }
        if ($category['name'] == 'Laptop') {
            $data[] = ['name' => 'LENOVO', 'status' => 1, 'category_id' => $category['id'], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
            $data[] = ['name' => 'MACBOOK', 'status' => 1, 'category_id' => $category['id'], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
            $data[] = ['name' => 'DELL', 'status' => 1, 'category_id' => $category['id'], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
        }
        if ($category['name'] == 'Chuột') {
            $data[] = ['name' => 'Logitech', 'status' => 1, 'category_id' => $category['id'], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
            $data[] = ['name' => 'Fnatic', 'status' => 1, 'category_id' => $category['id'], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
            $data[] = ['name' => 'Vancer', 'status' => 1, 'category_id' => $category['id'], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
        }
    }

    $this->table('category_values')->insert($data)->save();
    }
}

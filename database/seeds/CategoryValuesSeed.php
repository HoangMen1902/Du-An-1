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
    $categories = $this->fetchAll("SELECT id, name FROM categories WHERE name IN ('DELL', 'LENOVO', 'ASUS')");

    $data = [];

    foreach ($categories as $category) {
        if ($category['name'] == 'DELL') {
            $data[] = ['name' => 'Laptop DELL XPS', 'status' => 1, 'category_id' => $category['id'], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
            $data[] = ['name' => 'Laptop DELL Inspiron', 'status' => 1, 'category_id' => $category['id'], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
        }
        if ($category['name'] == 'LENOVO') {
            $data[] = ['name' => 'Laptop LENOVO ThinkPad', 'status' => 1, 'category_id' => $category['id'], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
            $data[] = ['name' => 'Laptop LENOVO IdeaPad', 'status' => 1, 'category_id' => $category['id'], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
        }
        if ($category['name'] == 'ASUS') {
            $data[] = ['name' => 'Laptop ASUS ZenBook', 'status' => 1, 'category_id' => $category['id'], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
            $data[] = ['name' => 'Laptop ASUS ROG', 'status' => 1, 'category_id' => $category['id'], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
        }
    }

    $this->table('category_values')->insert($data)->save();
    }
}

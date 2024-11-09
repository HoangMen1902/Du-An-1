<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
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
        $data = [
            [
                'firstname'    => 'Ly',
                'lastname' => 'Hoang Men',
                'email' => 'hoangmen0715@gmail.com',
                'phone' => '0943653646',
                'password' => 'hahaha',
                'username' => '7CO'

            ],[
                'firstname'    => 'Lee',
                'lastname' => 'Wool Mean',
                'email' => 'hoangmen@gmail.com',
                'phone' => '0943653642',
                'password' => 'hahaha',
                'username' => '7CO2'
            ],[
                'firstname'    => 'LEEE',
                'lastname' => 'HOAL MEL',
                'email' => 'h0715@gmail.com',
                'phone' => '0943653641',
                'password' => 'hahaha2',
                'username' => '7CO6'
            ],[
                'firstname'    => 'Lee',
                'lastname' => 'Sin',
                'email' => 'hoan2715@gmail.com',
                'phone' => '0943653645',
                'password' => 'hahaha123',
                'username' => '7CO52'
            ]
            ,[
                'firstname'    => 'Lee',
                'lastname' => 'Min hoo',
                'email' => 'hoangme15@gmail.com',
                'phone' => '0943652346',
                'password' => 'hahah22a',
                'username' => '7CO12'
            ]
            ,[
                'firstname'    => 'Lee12321',
                'lastname' => 'Min 123213hoo',
                'email' => 'ho123213angme15@gmail.com',
                'phone' => '0922652346',
                'password' => 'hahah22a',
                'username' => '7CO11232132',
                'status' => '2'
            ]
            ,[
                'firstname'    => 'Lee12312',
                'lastname' => 'Min hoo3123123',
                'email' => 'hoangme1231231215@gmail.com',
                'phone' => '0943352346',
                'password' => 'hahah22123123a',
                'username' => '7CO12123123',
                'status' => '2'
                
            ]
        ];

        $users = $this->table('users');
        $users->insert($data)
              ->saveData();
    }
}

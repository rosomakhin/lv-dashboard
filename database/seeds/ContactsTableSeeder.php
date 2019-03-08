<?php

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            try {
                $tel = random_int(100000000000, 999999999999);
            } catch (Exception $e) {
                $tel = 999999999999;
            }

            try {
                $createdAt = random_int(1546335698, 1548841298);
            } catch (Exception $e) {
                $createdAt = 1546335698;
            }

            DB::table('contacts')->insert([
                'name' => 'contact ' . $i,
                'email' => 'contact' . $i . '@site.com',
                'tel' => $tel,
                'created_at' => date('Y-m-d H:i:s', $createdAt),
            ]);
        }
    }
}

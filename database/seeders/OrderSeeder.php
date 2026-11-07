<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('shoppingorder')->insert([
            ['shoppingOrderId' => 1, 'orderDate' => '2026-06-19 08:14:03', 'firstName' => 'test', 'lastName' => 'test', 'address' => '123 test', 'contactNumber' => '1235698745', 'email' => 'test@test.com', 'creditCardNumber' => '1234123412341234', 'expiryDate' => '10/30', 'nameOnCard' => 'test test', 'csv' => '236'],
            ['shoppingOrderId' => 2, 'orderDate' => '2026-06-19 08:16:32', 'firstName' => 'Just', 'lastName' => 'Testing', 'address' => '88 test street', 'contactNumber' => '0400123456', 'email' => 'testing@test.com.au', 'creditCardNumber' => '4569856945217894', 'expiryDate' => '01/30', 'nameOnCard' => 'just testing', 'csv' => '963'],
            ['shoppingOrderId' => 3, 'orderDate' => '2026-06-30 08:02:23', 'firstName' => 'Test', 'lastName' => 'Person', 'address' => '123 Somewhere St', 'contactNumber' => '0404 040 404', 'email' => 'test@test.com', 'creditCardNumber' => '1234123412341234', 'expiryDate' => '12/12', 'nameOnCard' => 'T PERSON', 'csv' => '321'],
        ]);

        DB::table('orderitem')->insert([
            ['itemId' => 5, 'shoppingOrderId' => 2, 'quantity' => 1, 'price' => 160.00],
            ['itemId' => 9, 'shoppingOrderId' => 1, 'quantity' => 1, 'price' => 55.99],
            ['itemId' => 22, 'shoppingOrderId' => 3, 'quantity' => 23, 'price' => 79.95],
        ]);
    }
}

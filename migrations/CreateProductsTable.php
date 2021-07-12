<?php

namespace Migrations;

use Framework\Interfaces\Migration;

class CreateProductsTable implements Migration
{
    public function up()
    {
        return "
            CREATE TABLE IF NOT EXISTS products (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `name` VARCHAR(40) NOT NULL,
                `value` FLOAT NOT NULL
            );
        ";
    }

    public function down()
    {
        return "
            DROP TABLE IF EXISTS products;
        ";
    }
}

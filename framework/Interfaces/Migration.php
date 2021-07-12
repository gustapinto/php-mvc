<?php

namespace Framework\Interfaces;

interface Migration
{
    public function up();

    public function down();
}

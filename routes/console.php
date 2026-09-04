<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('Easyhairsolutions:about', function () {
    $this->info('Easyhairsolutions — modern hair appointments + ecommerce.');
})->purpose('Display Easyhairsolutions application information');

<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Tâche planifiée pour régénérer le sitemap quotidiennement
Schedule::command('sitemap:generate')
    ->daily()
    ->description('Régénérer le sitemap XML quotidiennement');

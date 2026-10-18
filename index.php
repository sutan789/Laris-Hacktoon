<?php

/**
 * LARIS - AI Business Intelligence Platform
 * Root index.php - forwards all requests to laris_app/public/
 * 
 * Dipakai sebagai fallback jika .htaccess tidak diproses
 * untuk hosting yang document root-nya di sini.
 */

// Ubah path relatif ke laris_app/public
$publicPath = __DIR__ . '/laris_app/public';

// Set DOCUMENT_ROOT supaya Laravel bootstrap benar
$_SERVER['DOCUMENT_ROOT'] = $publicPath;
chdir($publicPath);

// Muat index.php dari public Laravel
require $publicPath . '/index.php';

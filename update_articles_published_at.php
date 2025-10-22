<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

// Update articles yang published_at nya NULL
$updated = DB::table('articles')
    ->whereNull('published_at')
    ->update(['published_at' => DB::raw('created_at')]);

echo "✅ Updated {$updated} articles with published_at from created_at\n";

// Show sample
$articles = DB::table('articles')->select('id', 'title', 'published_at')->limit(5)->get();
echo "\n📰 Sample Articles:\n";
foreach ($articles as $article) {
    echo "   - ID {$article->id}: {$article->title} (Published: {$article->published_at})\n";
}

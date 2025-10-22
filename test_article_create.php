<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Article;
use Illuminate\Support\Str;

echo "🧪 Testing Article Creation...\n\n";

try {
    // Test create article
    $article = Article::create([
        'title' => 'Test Artikel - ' . now()->format('Y-m-d H:i:s'),
        'slug' => Str::slug('Test Artikel - ' . now()->format('Y-m-d H:i:s')),
        'type' => 'berita',
        'content' => 'Ini adalah konten test artikel.',
        'published_at' => now(),
    ]);

    echo "✅ Article created successfully!\n";
    echo "   ID: {$article->id}\n";
    echo "   Title: {$article->title}\n";
    echo "   Slug: {$article->slug}\n";
    echo "   Type: {$article->type}\n";
    echo "   Published: {$article->published_at}\n\n";

    // Delete test article
    $article->delete();
    echo "✅ Test article deleted (cleanup)\n";

} catch (\Exception $e) {
    echo "❌ ERROR: {$e->getMessage()}\n";
    echo "   File: {$e->getFile()}:{$e->getLine()}\n";
}

echo "\n📋 Check articles table structure:\n";
$columns = DB::select("SHOW COLUMNS FROM articles");
foreach ($columns as $column) {
    $nullable = $column->Null === 'YES' ? 'NULL' : 'NOT NULL';
    $default = $column->Default ? "DEFAULT '{$column->Default}'" : '';
    echo "   - {$column->Field}: {$column->Type} {$nullable} {$default}\n";
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Add slug column if it doesn't exist (nullable first)
            if (!Schema::hasColumn('articles', 'slug')) {
                $table->string('slug')->nullable()->after('title');
            }
        });

        // Generate slug for existing articles
        $articles = DB::table('articles')->get();
        foreach ($articles as $article) {
            $slug = Str::slug($article->title);
            
            // Make slug unique if duplicate exists
            $count = 1;
            $originalSlug = $slug;
            while (DB::table('articles')->where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            
            DB::table('articles')->where('id', $article->id)->update(['slug' => $slug]);
        }

        // Now make slug unique and not nullable
        Schema::table('articles', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'slug')) {
                $table->dropColumn('slug');
            }
        });
    }
};

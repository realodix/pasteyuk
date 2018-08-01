<?php

use Illuminate\Database\Seeder;

class PastesSyntax extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pastes_syntax')->insert(['syntax_id' => '0', 'syntax_name' => 'Text']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'c', 'syntax_name' => 'C']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'cpp', 'syntax_name' => 'C++']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'csharp', 'syntax_name' => 'C#']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'css', 'syntax_name' => 'CSS']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'git', 'syntax_name' => 'Git']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'html', 'syntax_name' => 'HTML']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'java', 'syntax_name' => 'Java']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'js', 'syntax_name' => 'JavaScript']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'json', 'syntax_name' => 'JSON']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'jsx', 'syntax_name' => 'React JSX']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'kotlin', 'syntax_name' => 'Kotlin']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'less', 'syntax_name' => 'Less']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'markdown', 'syntax_name' => 'Markdown']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'php', 'syntax_name' => 'PHP']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'python', 'syntax_name' => 'Python']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'sass', 'syntax_name' => 'Sass (sass)']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'scss', 'syntax_name' => 'Sass (scss)']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'stylus', 'syntax_name' => 'Stylus']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'swift', 'syntax_name' => 'Swift']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'tsx', 'syntax_name' => 'React TSX']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'twig', 'syntax_name' => 'Twig']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'typescript', 'syntax_name' => 'TypeScript']);
        DB::table('pastes_syntax')->insert(['syntax_id' => 'yaml', 'syntax_name' => 'YAML']);
    }
}

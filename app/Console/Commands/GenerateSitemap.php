<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap.xml for the website';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0))
            ->add(Url::create('/services')->setPriority(0.9))
            ->add(Url::create('/about')->setPriority(0.8))
            // Add more URLs as needed
            ->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated!');
    }
}
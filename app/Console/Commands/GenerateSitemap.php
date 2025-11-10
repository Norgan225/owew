<?php

namespace App\Console\Commands;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\Gallery;
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
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Générer le sitemap XML du site OWEW';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Génération du sitemap en cours...');

        $sitemap = Sitemap::create();

        // Pages statiques principales
        $sitemap->add(Url::create('/')->setPriority(1.0)->setChangeFrequency('daily'));
        $sitemap->add(Url::create('/about')->setPriority(0.8)->setChangeFrequency('monthly'));
        $sitemap->add(Url::create('/projects')->setPriority(0.9)->setChangeFrequency('weekly'));
        $sitemap->add(Url::create('/blog')->setPriority(0.8)->setChangeFrequency('daily'));
        $sitemap->add(Url::create('/gallery')->setPriority(0.7)->setChangeFrequency('weekly'));
        $sitemap->add(Url::create('/testimonials')->setPriority(0.6)->setChangeFrequency('monthly'));
        $sitemap->add(Url::create('/contact')->setPriority(0.8)->setChangeFrequency('monthly'));
        $sitemap->add(Url::create('/donate')->setPriority(0.9)->setChangeFrequency('monthly'));

        // Projets
        $projects = Project::where('status', 'active')->get();
        foreach ($projects as $project) {
            $sitemap->add(
                Url::create("/projects/{$project->slug}")
                    ->setLastModificationDate($project->updated_at)
                    ->setPriority(0.8)
                    ->setChangeFrequency('weekly')
            );
        }

        // Articles de blog
        $blogPosts = BlogPost::where('status', 'published')->get();
        foreach ($blogPosts as $post) {
            $sitemap->add(
                Url::create("/blog/{$post->slug}")
                    ->setLastModificationDate($post->updated_at)
                    ->setPriority(0.7)
                    ->setChangeFrequency('monthly')
            );
        }

        // Catégories de blog
        $categories = Category::all();
        foreach ($categories as $category) {
            $sitemap->add(
                Url::create("/blog/category/{$category->slug}")
                    ->setLastModificationDate($category->updated_at)
                    ->setPriority(0.6)
                    ->setChangeFrequency('weekly')
            );
        }

        // Témoignages
        $testimonials = Testimonial::where('is_published', true)->get();
        foreach ($testimonials as $testimonial) {
            $sitemap->add(
                Url::create("/testimonials/{$testimonial->id}")
                    ->setLastModificationDate($testimonial->updated_at)
                    ->setPriority(0.5)
                    ->setChangeFrequency('monthly')
            );
        }

        // Galerie
        $galleries = Gallery::where('is_published', true)->get();
        foreach ($galleries as $gallery) {
            $sitemap->add(
                Url::create("/gallery/{$gallery->id}")
                    ->setLastModificationDate($gallery->updated_at)
                    ->setPriority(0.6)
                    ->setChangeFrequency('weekly')
            );
        }

        // Sauvegarder le sitemap
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap généré avec succès !');
        $this->info('Fichier créé : public/sitemap.xml');
        $this->info('Nombre d\'URLs incluses : ' . count($sitemap->getTags()));
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name_fr' => 'Projets',
                'name_en' => 'Projects',
                'slug' => 'projets',
                'description_fr' => 'Photos de nos projets en cours et réalisés dans différentes communautés',
                'description_en' => 'Photos of our ongoing and completed projects in various communities',
            ],
            [
                'name_fr' => 'Événements',
                'name_en' => 'Events',
                'slug' => 'evenements',
                'description_fr' => 'Couverture de nos événements caritatifs, galas, collectes de fonds et activités spéciales',
                'description_en' => 'Coverage of our charity events, galas, fundraisers and special activities',
            ],
            [
                'name_fr' => 'Équipe & Bénévoles',
                'name_en' => 'Team & Volunteers',
                'slug' => 'equipe-benevoles',
                'description_fr' => 'Photos de notre équipe, bénévoles et moments de travail en commun',
                'description_en' => 'Photos of our team, volunteers and collaborative work moments',
            ],
            [
                'name_fr' => 'Bénéficiaires',
                'name_en' => 'Beneficiaries',
                'slug' => 'beneficiaires',
                'description_fr' => 'Les personnes et communautés que nous aidons à travers nos programmes',
                'description_en' => 'The people and communities we help through our programs',
            ],
            [
                'name_fr' => 'Partenariats',
                'name_en' => 'Partnerships',
                'slug' => 'partenariats',
                'description_fr' => 'Rencontres avec nos partenaires, sponsors et collaborateurs institutionnels',
                'description_en' => 'Meetings with our partners, sponsors and institutional collaborators',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}

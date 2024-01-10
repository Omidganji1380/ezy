<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Icon;
use App\Models\Option;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        if (!Option::query()->where(['option' => 'title'])->first())
            Option::query()->create([
                'option' => 'title',
                'value'  => 'Datech',
            ]);
        $a = ['ez ez-Cassets',
              'ez ez-Castbox',
              'ez ez-Clubhouse',
              'ez ez-Discord',
              'ez ez-dribble',
              'ez ez-eeita',
              'ez ez-facebook',
              'ez ez-gap',
              'ez ez-google-play',
              'ez ez-Google-Podcasts',
              'ez ez-i-apps',
              'ez ez-instagram',
              'ez ez-iTunes',
              'ez ez-kik',
              'ez ez-line',
              'ez ez-linkedin',
              'ez ez-massenger',
              'ez ez-mayket',
              'ez ez-overcast',
              'ez ez-Patreon',
              'ez ez-pintrest',
              'ez ez-podbean',
              'ez ez-Public-radio',
              'ez ez-rubika',
              'ez ez-sib-app',
              'ez ez-skype',
              'ez ez-sound-cloud',
              'ez ez-sourosh',
              'ez ez-spotify',
              'ez ez-Telegram',
              'ez ez-tiktok',
              'ez ez-twitch',
              'ez ez-twitter',
              'ez ez-Viber',
              'ez ez-whatsapp',
              'ez ez-youtube',
              'ez ez-aparat',
              'ez ez-Apple-Music',
              'ez ez-Apple-Podcasts',
              'ez ez-apple-store',
              'ez ez-bale',
              'ez ez-behance',
              'ez ez-cafe-bazaar',
              'ez ez-link-break',
              'ez ez-link',
              'ez ez-photo',
              'ez ez-slider-vertical',
              'ez ez-social-instagram',
              'ez ez-text-align-center',
              'ez ez-time-hourglass',
              'ez ez-video-library',
              'ez ez-chat-writing',
              'ez ez-help-faq',
              'ez ez-location',
              'ez ez-page-separator',
              'ez ez-vcf',];
        $a = array_unique($a);
        foreach ($a as $item) {
            if (!Icon::query()->where(['icon' => $item])->first())
                Icon::query()->create([
                    'icon' => $item
                ]);
        }
    }
}

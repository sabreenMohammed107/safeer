<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $members = [
            [
                'en_name' => 'Ahmed Yilmaz',
                'ar_name' => 'أحمد يلماز',
                'en_job' => 'Founder & CEO',
                'ar_job' => 'المؤسس والرئيس التنفيذي',
                'en_description' => 'Ahmed founded Safer Tourism with a decade of experience in the travel industry, leading the company\'s vision to deliver unforgettable journeys across Turkey and beyond.',
                'ar_description' => 'أسس أحمد شركة سافر السياحية بخبرة تمتد لعشر سنوات في مجال السفر، ويقود رؤية الشركة لتقديم رحلات لا تُنسى في تركيا وخارجها.',
                'featured' => true,
                'color' => [28, 68, 130],
            ],
            [
                'en_name' => 'Layla Hassan',
                'ar_name' => 'ليلى حسن',
                'en_job' => 'Head of Operations',
                'ar_job' => 'رئيسة العمليات',
                'en_description' => 'Layla oversees daily operations, ensuring every tour, transfer, and hotel booking runs smoothly for every guest.',
                'ar_description' => 'تشرف ليلى على العمليات اليومية، وتضمن سير كل جولة ونقل وحجز فندقي بسلاسة لكل ضيف.',
                'featured' => true,
                'color' => [104, 194, 229],
            ],
            [
                'en_name' => 'Mert Demir',
                'ar_name' => 'مرت دمير',
                'en_job' => 'Senior Tour Guide',
                'ar_job' => 'مرشد سياحي أول',
                'en_description' => null,
                'ar_description' => null,
                'featured' => false,
                'color' => [33, 13, 58],
            ],
            [
                'en_name' => 'Sara Ibrahim',
                'ar_name' => 'سارة إبراهيم',
                'en_job' => 'Customer Relations Manager',
                'ar_job' => 'مديرة علاقات العملاء',
                'en_description' => null,
                'ar_description' => null,
                'featured' => false,
                'color' => [95, 88, 88],
            ],
            [
                'en_name' => 'Emre Kaya',
                'ar_name' => 'إمره كايا',
                'en_job' => 'Transfer Coordinator',
                'ar_job' => 'منسق النقل',
                'en_description' => null,
                'ar_description' => null,
                'featured' => false,
                'color' => [28, 68, 130],
            ],
            [
                'en_name' => 'Nour Al-Sayed',
                'ar_name' => 'نور السيد',
                'en_job' => 'Visa Services Specialist',
                'ar_job' => 'أخصائية خدمات التأشيرات',
                'en_description' => null,
                'ar_description' => null,
                'featured' => false,
                'color' => [104, 194, 229],
            ],
        ];

        $uploadPath = public_path('uploads/teams');
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        foreach ($members as $index => $member) {
            $imageName = 'seed-' . ($index + 1) . '.jpg';
            $this->makePlaceholderImage($uploadPath . '/' . $imageName, $member['en_name'], $member['color']);

            Team::create([
                'en_name' => $member['en_name'],
                'ar_name' => $member['ar_name'],
                'en_job' => $member['en_job'],
                'ar_job' => $member['ar_job'],
                'en_description' => $member['en_description'],
                'ar_description' => $member['ar_description'],
                'image' => $imageName,
                'featured' => $member['featured'],
                'active' => true,
                'order' => $index + 1,
            ]);
        }
    }

    /**
     * Generate a simple solid-color placeholder photo with initials, so the
     * seeded team page has something visual to preview before real photos
     * are uploaded through the admin panel.
     */
    private function makePlaceholderImage(string $path, string $name, array $rgb): void
    {
        $size = 600;
        $image = imagecreatetruecolor($size, $size);
        $bg = imagecolorallocate($image, $rgb[0], $rgb[1], $rgb[2]);
        imagefill($image, 0, 0, $bg);

        $initials = collect(explode(' ', $name))
            ->map(fn ($part) => mb_substr($part, 0, 1))
            ->take(2)
            ->implode('');

        // GD's built-in bitmap fonts are small (max ~15px tall), so draw the
        // initials onto a small canvas and scale that up onto the full-size
        // background for a bigger, still-crisp result without needing a
        // bundled TTF font.
        $font = 5;
        $textWidth = imagefontwidth($font) * strlen($initials);
        $textHeight = imagefontheight($font);

        $small = imagecreatetruecolor($textWidth, $textHeight);
        $smallBg = imagecolorallocate($small, $rgb[0], $rgb[1], $rgb[2]);
        imagefill($small, 0, 0, $smallBg);
        $smallWhite = imagecolorallocate($small, 255, 255, 255);
        imagestring($small, $font, 0, 0, $initials, $smallWhite);

        $scale = 6;
        $scaledWidth = $textWidth * $scale;
        $scaledHeight = $textHeight * $scale;
        imagecopyresampled(
            $image,
            $small,
            (int) (($size - $scaledWidth) / 2),
            (int) (($size - $scaledHeight) / 2),
            0,
            0,
            $scaledWidth,
            $scaledHeight,
            $textWidth,
            $textHeight
        );
        imagedestroy($small);

        imagejpeg($image, $path, 85);
        imagedestroy($image);
    }
}

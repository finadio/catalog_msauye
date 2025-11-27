<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Community;
use App\Models\User;
use App\Models\CommunityMember;
use App\Models\CommunityPost;
use App\Models\CommunityComment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create 10 Communities
        $communitiesData = [
            [
                'name' => 'Komunitas UMKM Kreatif',
                'description' => 'Komunitas yang berfokus pada pengembangan UMKM kreatif di Yogyakarta.',
                'location' => 'Yogyakarta',
                'keyword' => 'creative',
            ],
            [
                'name' => 'Komunitas Digital Marketing',
                'description' => 'Komunitas belajar digital marketing untuk pelaku UMKM.',
                'location' => 'Sleman',
                'keyword' => 'digital',
            ],
            [
                'name' => 'Komunitas Pengrajin Lokal',
                'description' => 'Tempat berkumpul para pengrajin lokal untuk berbagi ilmu dan pengalaman.',
                'location' => 'Bantul',
                'keyword' => 'craft',
            ],
            [
                'name' => 'Komunitas Kuliner Nusantara',
                'description' => 'Wadah bagi pengusaha kuliner untuk melestarikan masakan nusantara.',
                'location' => 'Jakarta',
                'keyword' => 'food',
            ],
            [
                'name' => 'Komunitas Fashion Batik',
                'description' => 'Komunitas pecinta dan pengusaha batik Indonesia.',
                'location' => 'Solo',
                'keyword' => 'fashion',
            ],
            [
                'name' => 'Komunitas Startup Teknologi',
                'description' => 'Forum diskusi bagi founder startup dan pegiat teknologi.',
                'location' => 'Bandung',
                'keyword' => 'tech',
            ],
            [
                'name' => 'Komunitas Petani Modern',
                'description' => 'Berbagi inovasi dan teknologi di bidang pertanian.',
                'location' => 'Malang',
                'keyword' => 'farm',
            ],
            [
                'name' => 'Komunitas Ekspor Impor',
                'description' => 'Belajar bersama tentang prosedur dan strategi ekspor impor.',
                'location' => 'Surabaya',
                'keyword' => 'shipping',
            ],
            [
                'name' => 'Komunitas Wirausaha Muda',
                'description' => 'Membangun semangat kewirausahaan di kalangan anak muda.',
                'location' => 'Semarang',
                'keyword' => 'youth',
            ],
            [
                'name' => 'Komunitas Bisnis Syariah',
                'description' => 'Penerapan prinsip syariah dalam bisnis modern.',
                'location' => 'Aceh',
                'keyword' => 'business',
            ],
        ];

        foreach ($communitiesData as $data) {
            Community::updateOrCreate(
                ['slug' => Str::slug($data['name'])],
                [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'location' => $data['location'],
                    'photo' => 'https://loremflickr.com/640/480/' . $data['keyword'] . ',team',
                    'image' => 'https://loremflickr.com/1280/720/' . $data['keyword'] . ',meeting',
                    'logo' => 'https://loremflickr.com/200/200/' . $data['keyword'] . ',logo',
                    'type' => 'Publik',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // 2. Get Users
        $testUser = User::where('email', 'umkm@example.com')->first();
        $otherUsers = User::where('role', 'umkm')->where('email', '!=', 'umkm@example.com')->get();

        if (!$testUser) {
            $this->command->info('User umkm@example.com not found. Skipping member seeding for test user.');
        }

        $allCommunities = Community::all();

        // 3. Assign Memberships
        foreach ($allCommunities as $index => $community) {
            // Assign Test User
            if ($testUser) {
                // Make Admin of the first community
                $role = ($index === 0) ? 'admin' : 'member';
                
                CommunityMember::updateOrCreate(
                    [
                        'community_id' => $community->id,
                        'user_id' => $testUser->id,
                    ],
                    [
                        'role' => $role,
                        'status' => 'approved',
                        'join_reason' => 'Ingin berkontribusi dan belajar.',
                    ]
                );
            }

            // Assign Other Users (Randomly)
            foreach ($otherUsers as $user) {
                if (rand(0, 1)) { // 50% chance to join
                    CommunityMember::updateOrCreate(
                        [
                            'community_id' => $community->id,
                            'user_id' => $user->id,
                        ],
                        [
                            'role' => 'member',
                            'status' => 'approved',
                            'join_reason' => 'Tertarik dengan komunitas ini.',
                        ]
                    );
                }
            }
        }

        // 4. Create Posts and Comments
        $members = CommunityMember::with('user')->get();

        if ($members->count() > 0) {
            foreach ($allCommunities as $community) {
                // Create 3-5 posts per community
                for ($i = 0; $i < rand(3, 5); $i++) {
                    $poster = $members->where('community_id', $community->id)->random();
                    
                    $post = CommunityPost::create([
                        'community_id' => $community->id,
                        'user_id' => $poster->user_id,
                        'title' => 'Diskusi tentang ' . $community->name . ' #' . ($i + 1),
                        'content' => 'Halo semua, saya ingin berdiskusi mengenai perkembangan terkini di bidang ini. Bagaimana pendapat teman-teman?',
                        'is_pinned' => ($i === 0), // Pin the first post
                        'created_at' => now()->subDays(rand(1, 30)),
                    ]);

                    // Create 2-4 comments per post
                    for ($j = 0; $j < rand(2, 4); $j++) {
                        $commenter = $members->where('community_id', $community->id)->random();
                        
                        CommunityComment::create([
                            'community_post_id' => $post->id,
                            'user_id' => $commenter->user_id,
                            'content' => 'Sangat menarik! Saya setuju dengan poin tersebut. Terima kasih sudah berbagi.',
                            'created_at' => $post->created_at->addHours(rand(1, 24)),
                        ]);
                    }
                }
            }
        }
    }
}

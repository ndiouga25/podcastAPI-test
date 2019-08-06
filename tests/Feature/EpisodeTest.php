<?php

namespace Tests\Feature;

use App\Episode;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EpisodeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testsEpisodesAreCreatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'url' => 'https://www.youtube.com/watch?v=ULwUzF1q5w4',
            'title' => 'house of card',
            'description' => 'Ruthless and cunning, Congressman Francis Underwood (Oscar winner Kevin Spacey) and his',
            'numepisode' => 23,
            'datecreate' => date('Y-m-d h:i:s'),
            'dateupdate' => '',
        ];

        $this->json('POST', '/api/episodes', $payload, $headers)
            ->assertStatus(200)
            ->assertJson(['id' => 1,'url'=> 'https://www.youtube.com/watch?v=ULwUzF1q5w4', 'title' => 'house of card', 'description' => 'Ruthless and cunning, Congressman Francis Underwood (Oscar winner Kevin Spacey) and his'
            ,'numepisode' => 23,'datecreate' => date('Y-m-d h:i:s'), 'dateupdate' => '']);
    }

    public function testEpisodesAreListedCorrectly()
    {
        factory(Episode::class)->create([
            'url' => 'https://www.youtube.com/watch?v=ULwUzF1q5w4',
            'title' => 'house of card',
            'description' => 'Ruthless and cunning, Congressman Francis Underwood (Oscar winner Kevin Spacey) and his',
            'numepisode' => 23,
            'datecreate' => date('Y-m-d h:i:s'),
            'dateupdate' => '',
        ]);

        factory(Episode::class)->create([
            'url' => 'https://www.youtube.com/watch?v=ULwUzF1q5w4',
            'title' => 'house of card',
            'description' => 'Ruthless and cunning, Congressman Francis Underwood (Oscar winner Kevin Spacey) and his',
            'numepisode' => 24,
            'datecreate' => date('Y-m-d h:i:s'),
            'dateupdate' => '',
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/episodes', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                ['url'=> 'https://www.youtube.com/watch?v=ULwUzF1q5w4', 'title' => 'house of card', 'description' => 'Ruthless and cunning, Congressman Francis Underwood (Oscar winner Kevin Spacey) and his'
                    ,'numepisode' => 23,'datecreate' => date('Y-m-d h:i:s'), 'dateupdate' => ''],
                ['url'=> 'https://www.youtube.com/watch?v=ULwUzF1q5w4', 'title' => 'house of card', 'description' => 'Ruthless and cunning, Congressman Francis Underwood (Oscar winner Kevin Spacey) and his'
                    ,'numepisode' => 24,'datecreate' => date('Y-m-d h:i:s'), 'dateupdate' => '']
            ])
            ->assertJsonStructure([
                '*' => ['url', 'title', 'description', 'created_at', 'updated_at'],
            ]);
    }

    public function testsEpisodesAreUpdatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $episodes = factory(Episode::class)->create([
            'url' => 'https://www.youtube.com/watch?v=ULwUzF1q5w4',
            'title' => 'house of card',
            'description' => 'Ruthless and cunning, Congressman Francis Underwood (Oscar winner Kevin Spacey) and his',
            'numepisode' => 23,
            'datecreate' => date('Y-m-d h:i:s'),
            'dateupdate' => '',
        ]);

        $payload = [
            'url' => 'https://www.youtube.com/watch?v=ULwUzF1q5w4',
            'title' => 'house of card',
            'description' => 'Ruthless and cunning, Congressman Francis Underwood (Oscar winner Kevin Spacey) and his',
            'numepisode' => 23,
            'datecreate' => date('Y-m-d h:i:s'),
            'dateupdate' => '',
        ];

        $response = $this->json('PUT', '/api/episodes/' . $episodes->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'url' => 'https://www.youtube.com/watch?v=ULwUzF1q5w4',
                'title' => 'house of card',
                'description' => 'Ruthless and cunning, Congressman Francis Underwood (Oscar winner Kevin Spacey) and his',
                'numepisode' => 23,
                'datecreate' => date('Y-m-d h:i:s'),
                'dateupdate' => ''
            ]);
    }

    public function testsEpisodesAreDeletedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $episodes = factory(Episode::class)->create([
            'url' => 'https://www.youtube.com/watch?v=ULwUzF1q5w4',
            'title' => 'house of card',
            'description' => 'Ruthless and cunning, Congressman Francis Underwood (Oscar winner Kevin Spacey) and his',
            'numepisode' => 23,
            'datecreate' => date('Y-m-d h:i:s'),
            'dateupdate' => '',
        ]);

        $this->json('DELETE', '/api/episodes/' . $episodes->id, [], $headers)
            ->assertStatus(204);
    }
}

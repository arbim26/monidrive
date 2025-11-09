<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Perjalanan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PerjalananControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_perjalanan()
    {
        $payload = [
            'user_id' => 1,
            'tujuan' => 'Jakarta',
            'lokasi_awal' => '-6.2,106.8',
            'lokasi_akhir' => '-7.8,110.4',
            'status' => 'aktif',
        ];

        $response = $this->postJson('/api/perjalanan', $payload);
        $response->assertStatus(201)
                 ->assertJsonStructure(['data' => ['id', 'tujuan', 'status']]);
    }

    /** @test */
    public function it_can_list_perjalanan()
    {
        Perjalanan::factory()->count(3)->create();

        $response = $this->getJson('/api/perjalanan');
        $response->assertStatus(200)
                 ->assertJsonStructure(['data' => [['id', 'tujuan']]]);
    }

    /** @test */
    public function it_can_show_perjalanan()
    {
        $data = Perjalanan::factory()->create();
        $response = $this->getJson("/api/perjalanan/{$data->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['tujuan' => $data->tujuan]);
    }

    /** @test */
    public function it_can_update_perjalanan()
    {
        $data = Perjalanan::factory()->create();
        $response = $this->putJson("/api/perjalanan/{$data->id}", [
            'status' => 'selesai'
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['status' => 'selesai']);
    }

    /** @test */
    public function it_can_delete_perjalanan()
    {
        $data = Perjalanan::factory()->create();

        $response = $this->deleteJson("/api/perjalanan/{$data->id}");
        $response->assertStatus(204);
    }
}

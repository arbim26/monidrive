<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\DetailPerjalanan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DetailPerjalananControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_detail_perjalanan()
    {
        $payload = [
            'perjalanan_id' => 1,
            'lokasi' => '-6.2,106.8',
            'kecepatan' => 80,
            'status_kendaraan' => 'berjalan',
            'waktu' => now()->toDateTimeString(),
        ];

        $response = $this->postJson('/api/detail-perjalanan', $payload);
        $response->assertStatus(201)
                 ->assertJsonStructure(['data' => ['id', 'lokasi', 'kecepatan']]);
    }

    /** @test */
    public function it_can_list_detail_perjalanan()
    {
        DetailPerjalanan::factory()->count(3)->create();

        $response = $this->getJson('/api/detail-perjalanan');
        $response->assertStatus(200)
                 ->assertJsonStructure(['data' => [['id', 'lokasi']]]);
    }

    /** @test */
    public function it_can_show_detail_perjalanan()
    {
        $data = DetailPerjalanan::factory()->create();
        $response = $this->getJson("/api/detail-perjalanan/{$data->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['lokasi' => $data->lokasi]);
    }

    /** @test */
    public function it_can_update_detail_perjalanan()
    {
        $data = DetailPerjalanan::factory()->create();

        $response = $this->putJson("/api/detail-perjalanan/{$data->id}", [
            'status_kendaraan' => 'berhenti'
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['status_kendaraan' => 'berhenti']);
    }

    /** @test */
    public function it_can_delete_detail_perjalanan()
    {
        $data = DetailPerjalanan::factory()->create();

        $response = $this->deleteJson("/api/detail-perjalanan/{$data->id}");
        $response->assertStatus(204);
    }
}

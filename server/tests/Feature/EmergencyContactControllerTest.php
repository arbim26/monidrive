<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\EmergencyContact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmergencyContactControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_emergency_contact()
    {
        $payload = [
            'user_id' => 1,
            'nama_kontak' => 'Ibu Sari',
            'nomor_telepon' => '0811223344',
            'hubungan' => 'ibu',
        ];

        $response = $this->postJson('/api/emergency-contact', $payload);
        $response->assertStatus(201)
                 ->assertJsonStructure(['data' => ['id', 'nama_kontak']]);
    }

    /** @test */
    public function it_can_list_emergency_contact()
    {
        EmergencyContact::factory()->count(3)->create();

        $response = $this->getJson('/api/emergency-contact');
        $response->assertStatus(200)
                 ->assertJsonStructure(['data' => [['id', 'nama_kontak']]]);
    }

    /** @test */
    public function it_can_show_emergency_contact()
    {
        $data = EmergencyContact::factory()->create();
        $response = $this->getJson("/api/emergency-contact/{$data->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['nama_kontak' => $data->nama_kontak]);
    }

    /** @test */
    public function it_can_update_emergency_contact()
    {
        $data = EmergencyContact::factory()->create();

        $response = $this->putJson("/api/emergency-contact/{$data->id}", [
            'hubungan' => 'rekan kerja'
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['hubungan' => 'rekan kerja']);
    }

    /** @test */
    public function it_can_delete_emergency_contact()
    {
        $data = EmergencyContact::factory()->create();

        $response = $this->deleteJson("/api/emergency-contact/{$data->id}");
        $response->assertStatus(204);
    }
}

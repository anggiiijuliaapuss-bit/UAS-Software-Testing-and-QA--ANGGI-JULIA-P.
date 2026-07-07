<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnggotaTest extends TestCase
{
    use RefreshDatabase;

    private function dataValid(array $override = []): array
    {
        return array_merge([
            'kode_anggota' => 'AG100',
            'nama' => 'Budi Santoso',
            'alamat' => 'Jl. Merdeka No. 10',
            'no_hp' => '081234567890',
            'email' => 'budi.santoso@gmail.com',
            'tgl_daftar' => '2026-01-01',
        ], $override);
    }

    /** @test */
    public function anggota_berhasil_disimpan_jika_seluruh_input_valid()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/anggota', $this->dataValid());

        $response->assertStatus(302);
        $response->assertRedirect(route('anggota.index'));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('anggota', [
            'kode_anggota' => 'AG100',
            'nama' => 'Budi Santoso',
            'email' => 'budi.santoso@gmail.com',
        ]);
    }

    /** @test */
    public function anggota_gagal_disimpan_jika_nama_mengandung_angka()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/anggota', $this->dataValid([
            'nama' => 'Budi Santoso 123',
        ]));

        $response->assertSessionHasErrors(['nama']);
        $this->assertDatabaseMissing('anggota', ['kode_anggota' => 'AG100']);
    }

    /** @test */
    public function anggota_gagal_disimpan_jika_email_tidak_valid()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/anggota', $this->dataValid([
            'email' => 'bukan-email-yang-benar',
        ]));

        $response->assertSessionHasErrors(['email']);
        $this->assertDatabaseMissing('anggota', ['kode_anggota' => 'AG100']);
    }

    /** @test */
    public function anggota_gagal_disimpan_jika_email_kosong()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/anggota', $this->dataValid([
            'email' => '',
        ]));

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function anggota_gagal_disimpan_jika_no_hp_tidak_diawali_08_atau_plus62()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/anggota', $this->dataValid([
            'no_hp' => '1234567890',
        ]));

        $response->assertSessionHasErrors(['no_hp']);
        $this->assertDatabaseMissing('anggota', ['kode_anggota' => 'AG100']);
    }

    /** @test */
    public function anggota_gagal_disimpan_jika_no_hp_kurang_dari_10_digit()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/anggota', $this->dataValid([
            'no_hp' => '0812345',
        ]));

        $response->assertSessionHasErrors(['no_hp']);
    }

    /** @test */
    public function anggota_berhasil_disimpan_dengan_no_hp_format_plus62()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/anggota', $this->dataValid([
            'kode_anggota' => 'AG101',
            'no_hp' => '+6281234567890',
            'email' => 'lain@gmail.com',
        ]));

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('anggota', ['kode_anggota' => 'AG101']);
    }
}

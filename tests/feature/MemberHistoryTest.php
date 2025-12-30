<?php

namespace Tests\Feature;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use App\Models\UserModel; // Myth Auth model usually

class MemberHistoryTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testLoginAndProfile()
    {
        // Perform real login attempt
        $result = $this->post('/login', [
            'login' => 'anggota1',
            'password' => 'anggota123'
        ]);

        // Assert redirect or succes
        // Typically redirects to / or /dashboard
        // $result->assertRedirect(); // Might redirect to /

        // Now with session established, visit profile
        $result = $this->get('/profile');

        $result->assertStatus(200);
        $result->assertSee('Profil Anggota');
        $result->assertSee('Riwayat Aktivitas Terakhir');
    }

    public function testPinjamPageHasHistory()
    {
        // Login first
        $this->post('/login', [
            'login' => 'anggota1',
            'password' => 'anggota123'
        ]);

        $result = $this->get('/pinjam');

        $result->assertStatus(200);
        $result->assertSee('Riwayat Pengembalian');
    }
}

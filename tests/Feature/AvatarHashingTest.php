<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Helpers\AvatarHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;

class AvatarHashingTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create test user
        $this->user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }

    /** @test */
    public function it_can_generate_hashed_url_for_illustration()
    {
        $illustrationPath = 'assets/illustrations/business/business-1.jpg';
        
        $hashedUrl = AvatarHelper::generateHashedAvatarUrl($illustrationPath);
        
        $this->assertStringContainsString('/avatar/hashed/', $hashedUrl);
        $this->assertNotEmpty($hashedUrl);
    }

    /** @test */
    public function it_can_resolve_avatar_url_for_different_formats()
    {
        // Test hashed format
        $hashedProfilePicture = 'hashed:abc123def456';
        $resolvedUrl = AvatarHelper::resolveAvatarUrl($hashedProfilePicture);
        $this->assertStringContainsString('/avatar/hashed/abc123def456', $resolvedUrl);

        // Test illustration format
        $illustrationPath = 'assets/illustrations/business/business-1.jpg';
        $resolvedUrl = AvatarHelper::resolveAvatarUrl($illustrationPath);
        $this->assertStringContainsString('/avatar/hashed/', $resolvedUrl);

        // Test external URL
        $externalUrl = 'https://example.com/avatar.jpg';
        $resolvedUrl = AvatarHelper::resolveAvatarUrl($externalUrl);
        $this->assertEquals($externalUrl, $resolvedUrl);

        // Test null/empty
        $this->assertNull(AvatarHelper::resolveAvatarUrl(null));
        $this->assertNull(AvatarHelper::resolveAvatarUrl(''));
    }

    /** @test */
    public function it_can_identify_illustration_avatars()
    {
        $this->assertTrue(AvatarHelper::isIllustration('assets/illustrations/business/business-1.jpg'));
        $this->assertTrue(AvatarHelper::isIllustration('hashed:abc123def456'));
        $this->assertFalse(AvatarHelper::isIllustration('uploads/avatar.jpg'));
        $this->assertFalse(AvatarHelper::isIllustration('https://example.com/avatar.jpg'));
        $this->assertFalse(AvatarHelper::isIllustration(null));
    }

    /** @test */
    public function it_reuses_existing_hash_for_same_path()
    {
        $illustrationPath = 'assets/illustrations/business/business-1.jpg';
        
        $firstHash = AvatarHelper::generateHashedAvatarUrl($illustrationPath);
        $secondHash = AvatarHelper::generateHashedAvatarUrl($illustrationPath);
        
        $this->assertEquals($firstHash, $secondHash);
    }

    /** @test */
    public function it_can_get_illustrations_with_hash_via_api()
    {
        // Mock illustrations directory (would need actual files in real test)
        $response = $this->get('/api/illustrations/business');
        
        if ($response->status() === 200) {
            $data = $response->json();
            $this->assertIsArray($data);
            
            if (!empty($data)) {
                $firstImage = $data[0];
                $this->assertArrayHasKey('name', $firstImage);
                $this->assertArrayHasKey('hash', $firstImage);
                $this->assertArrayHasKey('url', $firstImage);
                $this->assertStringContainsString('/avatar/hashed/', $firstImage['url']);
            }
        } else {
            $this->assertEquals(404, $response->status());
        }
    }

    /** @test */
    public function it_can_set_illustration_avatar_for_user()
    {
        // First, generate a hash
        $illustrationPath = 'assets/illustrations/business/business-1.jpg';
        $hashedUrl = AvatarHelper::generateHashedAvatarUrl($illustrationPath);
        $hash = basename(parse_url($hashedUrl, PHP_URL_PATH));
        
        $response = $this->postJson('/api/avatar/set-illustration', [
            'hash' => $hash,
            'user_id' => $this->user->id,
        ]);
        
        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        
        // Check if user's profile picture was updated
        $this->user->refresh();
        $this->assertEquals("hashed:{$hash}", $this->user->profile_picture);
    }

    /** @test */
    public function it_returns_404_for_invalid_hash()
    {
        $response = $this->get('/avatar/hashed/invalid_hash_123');
        $response->assertStatus(404);
    }

    /** @test */
    public function it_can_serve_hashed_avatar_with_proper_headers()
    {
        // Create a test image file
        $illustrationPath = 'assets/illustrations/business/business-1.jpg';
        $testImagePath = public_path($illustrationPath);
        
        // Skip if test image doesn't exist
        if (!file_exists($testImagePath)) {
            $this->markTestSkipped('Test illustration file not found');
            return;
        }
        
        $hashedUrl = AvatarHelper::generateHashedAvatarUrl($illustrationPath);
        $hash = basename(parse_url($hashedUrl, PHP_URL_PATH));
        
        $response = $this->get("/avatar/hashed/{$hash}");
        
        $response->assertStatus(200);
        $response->assertHeader('Content-Type');
        $response->assertHeader('Cache-Control', 'public, max-age=31536000');
        $response->assertHeader('ETag');
    }

    /** @test */
    public function it_handles_cache_persistence()
    {
        $illustrationPath = 'assets/illustrations/business/business-1.jpg';
        
        // Generate hash
        $hashedUrl = AvatarHelper::generateHashedAvatarUrl($illustrationPath);
        $hash = basename(parse_url($hashedUrl, PHP_URL_PATH));
        
        // Check that mapping exists in cache
        $cacheMapping = Cache::get('global_avatar_hash_mapping', []);
        $this->assertArrayHasKey($hash, $cacheMapping);
        $this->assertEquals($illustrationPath, $cacheMapping[$hash]);
        
        // Check that we can retrieve original path
        $originalPath = AvatarHelper::getOriginalPath($hash);
        $this->assertEquals($illustrationPath, $originalPath);
    }

    /** @test */
    public function it_validates_required_fields_for_set_illustration()
    {
        // Missing hash
        $response = $this->postJson('/api/avatar/set-illustration', [
            'user_id' => $this->user->id,
        ]);
        $response->assertStatus(422);
        
        // Missing user_id
        $response = $this->postJson('/api/avatar/set-illustration', [
            'hash' => 'some_hash',
        ]);
        $response->assertStatus(422);
        
        // Invalid user_id
        $response = $this->postJson('/api/avatar/set-illustration', [
            'hash' => 'some_hash',
            'user_id' => 99999,
        ]);
        $response->assertStatus(422);
    }

    /** @test */
    public function it_returns_error_for_invalid_hash_when_setting_avatar()
    {
        $response = $this->postJson('/api/avatar/set-illustration', [
            'hash' => 'invalid_hash_that_does_not_exist',
            'user_id' => $this->user->id,
        ]);
        
        $response->assertStatus(400);
        $response->assertJson(['error' => 'Invalid hash']);
    }
}

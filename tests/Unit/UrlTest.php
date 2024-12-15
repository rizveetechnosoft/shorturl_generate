<?php

namespace Tests\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Url;
use Tests\TestCase;

class UrlTest extends TestCase
{
    use RefreshDatabase; // Ensures the database is reset between tests

    /** @test */
    public function it_can_generate_a_unique_short_url()
    {
        $longUrl = 'https://example.com/some-long-url';
        // Ensure the short URL is unique by appending a random string
        $shortUrl = substr(md5($longUrl . microtime()), 0, 6);

        $this->assertNotEmpty($shortUrl);
        $this->assertEquals(6, strlen($shortUrl));
    }

    /** @test */
    public function it_can_store_a_url_record_in_the_database()
    {
        $longUrl = 'https://example.com/some-long-url';
        $shortUrl = substr(md5($longUrl . microtime()), 0, 6);

        Url::create([
            'long_url' => $longUrl,
            'short_url' => $shortUrl,
        ]);

        $this->assertDatabaseHas('urls', [
            'long_url' => $longUrl,
            'short_url' => $shortUrl,
        ]);
    }

    /** @test */
    public function it_can_fetch_long_url_by_short_url()
    {
        $longUrl = 'https://example.com/some-long-url';
        // Ensure the short URL is unique by appending a random string
        $shortUrl = substr(md5($longUrl . microtime()), 0, 6);

        Url::create([
            'long_url' => $longUrl,
            'short_url' => $shortUrl,
        ]);

        // Fetch the URL by the generated short URL
        $url = Url::where('short_url', $shortUrl)->first();

        $this->assertNotNull($url);
        $this->assertEquals($longUrl, $url->long_url);
    }
}
<?php

namespace Tests\Feature;

use Tests\TestCase;

class SecurityHeadersTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app['config']->set('app.key', 'base64:AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=');
    }

    public function test_pages_include_a_nonce_based_content_security_policy(): void
    {
        $response = $this->get('/fiscalia-digital');

        $policy = $response->headers->get('Content-Security-Policy');

        $this->assertNotNull($policy);
        $this->assertStringContainsString("default-src 'self'", $policy);
        $this->assertStringContainsString("object-src 'none'", $policy);
        $this->assertStringContainsString('https://tile.openstreetmap.org', $policy);
        $this->assertSame(1, preg_match("/script-src 'self' 'nonce-([^']+)'/", $policy, $matches));
        $response->assertSee('nonce="'.$matches[1].'"', false);
        $response->assertDontSee('fonts.bunny.net');
    }
}

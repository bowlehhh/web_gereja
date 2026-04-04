<?php

namespace Tests\Feature;

use App\Support\Turnstile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class LoginTurnstileTest extends TestCase
{
    public function test_turnstile_is_hidden_on_loopback_login_page(): void
    {
        config([
            'services.turnstile.site_key' => 'test-site-key',
            'services.turnstile.enforce_local' => true,
            'app.url' => 'http://127.0.0.1:8000',
        ]);

        $response = $this->get('/login');

        $response
            ->assertOk()
            ->assertDontSee('cf-turnstile', false)
            ->assertSee('Mode local/development aktif', false);
    }

    public function test_turnstile_should_render_for_non_local_deploy_hosts(): void
    {
        config([
            'app.env' => 'production',
            'app.url' => 'https://gkka.example.com',
            'services.turnstile.site_key' => 'test-site-key',
            'services.turnstile.secret_key' => 'test-secret-key',
            'services.turnstile.enforce_local' => false,
        ]);

        $request = Request::create('https://gkka.example.com/login', 'GET');
        $request->server->set('HTTP_HOST', 'gkka.example.com');

        $this->assertTrue(Turnstile::shouldRender($request));
    }

    public function test_turnstile_verification_bypasses_loopback_requests(): void
    {
        config([
            'app.env' => 'local',
            'app.url' => 'http://127.0.0.1:8000',
            'services.turnstile.site_key' => 'test-site-key',
            'services.turnstile.secret_key' => 'test-secret-key',
            'services.turnstile.enforce_local' => true,
        ]);

        $request = Request::create('http://127.0.0.1:8000/login', 'POST');

        $result = Turnstile::verify($request);

        $this->assertTrue($result['success']);
        $this->assertNull($result['message']);
    }

    public function test_turnstile_verification_calls_cloudflare_on_deploy_hosts(): void
    {
        config([
            'app.env' => 'production',
            'app.url' => 'https://gkka.example.com',
            'services.turnstile.site_key' => 'test-site-key',
            'services.turnstile.secret_key' => 'test-secret-key',
        ]);

        Http::fake([
            'https://challenges.cloudflare.com/turnstile/v0/siteverify' => Http::response([
                'success' => true,
            ], 200),
        ]);

        $request = Request::create('https://gkka.example.com/login', 'POST', [
            'cf-turnstile-response' => 'token-123',
        ]);
        $request->server->set('HTTP_HOST', 'gkka.example.com');
        $request->server->set('REMOTE_ADDR', '203.0.113.10');

        $result = Turnstile::verify($request);

        $this->assertTrue($result['success']);
        Http::assertSentCount(1);
    }
}

<?php

namespace Tests\Feature;

use App\Http\Middleware\ForceHttps;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ForceHttpsMiddlewareTest extends TestCase
{
    public function test_loopback_host_is_not_redirected_to_https(): void
    {
        config(['app.force_https' => true]);

        $response = $this->handleForceHttpsRequest('http://127.0.0.1:8000/up');

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test_localhost_is_not_redirected_to_https(): void
    {
        config(['app.force_https' => true]);

        $response = $this->handleForceHttpsRequest('http://localhost:8000/up');

        $this->assertSame(200, $response->getStatusCode());
    }

    public function test_non_loopback_host_is_redirected_to_https_when_enabled(): void
    {
        config(['app.force_https' => true]);

        $response = $this->handleForceHttpsRequest('http://example.com/up');

        $this->assertSame(301, $response->getStatusCode());
        $this->assertSame('https://example.com/up', $response->headers->get('Location'));
    }

    private function handleForceHttpsRequest(string $url): Response
    {
        $request = Request::create($url, 'GET');

        return (new ForceHttps())->handle(
            $request,
            fn () => response('ok'),
        );
    }
}

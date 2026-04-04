<?php

namespace Tests\Unit;

use App\Support\LoopbackHost;
use PHPUnit\Framework\TestCase;

class LoopbackHostTest extends TestCase
{
    public function test_it_detects_loopback_hosts(): void
    {
        $this->assertTrue(LoopbackHost::contains('127.0.0.1'));
        $this->assertTrue(LoopbackHost::contains('localhost'));
        $this->assertTrue(LoopbackHost::contains('::1'));
        $this->assertTrue(LoopbackHost::contains('[::1]'));
    }

    public function test_it_rejects_non_loopback_hosts(): void
    {
        $this->assertFalse(LoopbackHost::contains(null));
        $this->assertFalse(LoopbackHost::contains(''));
        $this->assertFalse(LoopbackHost::contains('192.168.0.10'));
        $this->assertFalse(LoopbackHost::contains('example.com'));
    }

    public function test_it_detects_loopback_hosts_inside_urls(): void
    {
        $this->assertTrue(LoopbackHost::urlUsesLoopbackHost('http://127.0.0.1:8000'));
        $this->assertTrue(LoopbackHost::urlUsesLoopbackHost('http://localhost'));
        $this->assertTrue(LoopbackHost::urlUsesLoopbackHost('http://[::1]:8000'));
        $this->assertFalse(LoopbackHost::urlUsesLoopbackHost('https://example.com'));
    }
}

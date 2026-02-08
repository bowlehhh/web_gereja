@extends('layout.app')

@section('title', 'Login Admin - GKKA Samarinda')

@section('content')
<section class="page-head">
  <div class="container">
    <h1 class="page-title">Login Admin</h1>
    <p class="page-sub">Masuk untuk mengelola Warta Jemaat, Gallery, Event, dan konten lainnya.</p>
  </div>
</section>

<section style="padding:24px 0 60px;">
  <div class="container" style="max-width:560px;">
    <div class="panel" style="padding:18px;">
      
      @if ($errors->any())
        <div style="background:#ffe4e6;border:1px solid #fecdd3;color:#9f1239;padding:12px;border-radius:12px;margin-bottom:14px;">
          {{ $errors->first() }}
        </div>
      @endif

      <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div style="display:grid; gap:12px;">
          <div>
            <label style="font-weight:800;color:#0b2b55;display:block;margin-bottom:6px;">Email</label>
            <input name="email" type="email" value="{{ old('email') }}" required
              style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid rgba(0,0,0,.15);outline:none;">
          </div>

          <div>
            <label style="font-weight:800;color:#0b2b55;display:block;margin-bottom:6px;">Password</label>
            <input name="password" type="password" required
              style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid rgba(0,0,0,.15);outline:none;">
          </div>

          <label style="display:flex;align-items:center;gap:8px;font-weight:700;color:#0b2b55;">
            <input type="checkbox" name="remember" value="1">
            Remember me
          </label>

          <button type="submit" class="hero-btn" style="width:100%;justify-content:center;">
            Login
          </button>
        </div>
      </form>

    </div>
  </div>
</section>
@endsection

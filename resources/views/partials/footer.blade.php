<footer class="footer">
  <div class="container">
    <div class="footer-grid">
      <div>
        <div class="footer-brand">
          <img class="footer-logo-img" src="{{ asset('assets/logo.png') }}" alt="Logo GKKA">
          <div>
            <div class="footer-title">GKKA Indonesia</div>
            <div class="footer-muted">Jemaat Samarinda</div>
          </div>
        </div>
        <div class="footer-text" style="margin-top:10px;">
          Alamat gereja (isi nanti)<br>
          Kontak: 08xx-xxxx-xxxx
        </div>
      </div>

      <div>
        <div class="footer-title">Gereja</div>
        <div class="footer-links">
          <a href="{{ route('gereja.sejarah') }}">Sejarah</a>
          <a href="{{ route('gereja.hamba') }}">Hamba Tuhan</a>
          <a href="{{ route('gereja.majelis') }}">Majelis</a>
          <a href="{{ route('gereja.komisi') }}">Komisi</a>
        </div>
      </div>

      <div>
        <div class="footer-title">Event</div>
        <div class="footer-links">
          <a href="{{ route('event') }}">Event</a>
        </div>
      </div>

      <div>
        <div class="footer-title">Lainnya</div>
        <div class="footer-links">
          <a href="{{ route('media') }}">Media</a>
          <a href="{{ route('gallery') }}">Gallery</a>
          <a href="{{ route('warta') }}">Warta Jemaat</a>
          <a href="{{ route('kontak') }}">Kontak</a>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      © {{ date('Y') }} GKKA Samarinda. All rights reserved.
    </div>
  </div>
</footer>

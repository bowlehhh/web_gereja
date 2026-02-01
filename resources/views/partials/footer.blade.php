<footer class="footer">
  <div class="container footer__grid">
    <div>
      <h4>GKKA Indonesia Jemaat Samarinda</h4>
      <p>Alamat gereja (isi nanti)</p>
      <p>Kontak: 08xx-xxxx-xxxx</p>
    </div>
    <div>
      <h4>Menu</h4>
      <a href="{{ route('sejarah') }}">Sejarah</a><br>
      <a href="{{ route('event') }}">Event</a><br>
      <a href="{{ route('warta') }}">Warta</a>
    </div>
    <div>
      <h4>Media</h4>
      <a href="#">YouTube</a><br>
      <a href="#">Instagram</a>
    </div>
  </div>

  <div class="footer__bottom">
    <div class="container">
      © {{ date('Y') }} GKKA Samarinda. All rights reserved.
    </div>
  </div>
</footer>

<footer id="footer">
  
    <div class="footer-top">
      <div class="container">
        <div class="row">
          @foreach ($profiles as $profile)   
            <div class="col-lg-6 col-md-6 footer-contact">
              <h3>Buah dan Sayur<span>.</span></h3>
              <p>{!! $profile->alamat !!}</p>
              <p><strong>Telepon: </strong>{{ $profile-> telp }}</p>
              <p><strong>Email: </strong>{{ $profile->email }}<p>
            </div>
  
            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Link Terkait</h4>
              <ul>
                <li><i class="bx bx-chevron-right"></i> <a href="/">Beranda</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="/home/catalogs">Katalog</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="/home/profiles">Tentang</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="/home/contacts">Kontak</a></li>
              </ul>
            </div>
  
            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Sosial Media</h4>
              <p>Sosial Media Buah dan Sayur</p>
              <div class="social-links mt-3">
                <a href="{{ $profile->link_whatsapp }}" target="_blank" class="whatsapp"><i class="bx bxl-whatsapp"></i></a>
                <a href="{{ $profile->link_facebook }}" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="{{ $profile->link_instagram }}" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="{{ $profile->link_youtube }}" target="_blank" class="youtube"><i class="bx bxl-youtube"></i></a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="container py-4">
      <div class="copyright">
        &copy; Copyright <strong><span>Buah dan Sayur</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Supported by <a href="https://telkomuniversity.ac.id/" target="_blank">Telkom University</a>, Designed by <a href="https://bootstrapmade.com/" target="_blank">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->
@extends('layouts.main')

@section('container')
    <div class="row justify-content-centerv mb-4">
        <p class="fs-2">Repository Politeknik Piksi Ganesha</p>
    </div>  

      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.683860734516!2d107.63515877209676!3d-6.928339867810489!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e62c85d4bcbd%3A0x33d8416165587aed!2sPoliteknik%20Piksi%20Ganesha!5e0!3m2!1sid!2sid!4v1693895374180!5m2!1sid!2sid" width="100%" height="300px" style="border:0; max-width: 1200px; justify-content: center;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <p class="fs-5 text-center">Jl. Gatot Subroto No.301, Maleer, Kec. Batununggal, Kota Bandung</p>


    <div class="container mb-3">
      <div class="row row-cols-1 row-cols-md-2">
        <div class="grid gap-3">
        <p class="fw-bold mt-5">Contact Us</p>
            <div class="p-2 g-col-6">
            <a class="nav-link" href="wa.me/62"><img src="/img/contact/phone.png" class="pe-4">0811 1212 1212 - John Doe
            </div>
            <div class="p-2 g-col-6">
            <a class="nav-link" href="https://www.youtube.com/c/PiksiGaneshaOfficial"><img src="/img/contact/youtube.png" alt="youtube" class="pe-3">Piksi Ganesha Official</a>
            </div>
            <div class="p-2 g-col-6">
            <a class="nav-link" href="https://www.instagram.com/piksi_ganesha/"><img src="/img/contact/instagram.png" alt="instagram" class="pe-3">@piksi_ganesha</a>
            </div>
        </div>

        <div class="grid gap-3">
        <p class="fw-bold mt-5">Kunjungi Kami</p>
            <div class="p-2 g-col-6">
            <a class="nav-link" href="https://piksi.ac.id"><img src="/img/contact/web.png" alt="web" class="pe-3">Politeknik Piksi Ganesha</a>
            </div>
            <div class="p-2 g-col-6">
            <a class="nav-link" href="https://journal.piksi.ac.id"><img src="/img/contact/jurnal.png" alt="jurnalpiksig" class="pe-3">Jurnal Politeknik Piksi Ganesha</a>
            </div>
            <div class="p-2 g-col-6">
            <a class="nav-link" href="https://digilib.piksi.ac.id"><img src="/img/contact/perpus.png" alt="perpus" class="pe-3">Perpustaaan Politeknik Piksi Ganesha</a>
            </div>
        </div>
      </div>
    </div>

    <div class="container-fluid dropend mt-5">
            <button class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="/img/user/admin.png" alt="admin">
            </button>
            <ul class="dropdown-menu margin-ha ms-5 w-auto" data-popper-placement="left-start">
              <li class="nav-item dropend">
                <a class="nav-link dropdown-toggle ms-2 me-2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Unggah Karya Ilmiah
                </a>
                <ul class="dropdown-menu text-wrap margin-ha" style="width: 500px; background-color: #E9DFEA">
                 <a class="dropdown-item text-wrap" style="width: 500px;">Pastikan anda sudah punya akun, kemudian kunjungi halaman 'unggah karya ilmiah', setelah itu isi form dan kirim</a>
                </ul>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li class="nav-item dropend">
                <a class="nav-link dropdown-toggle ms-2 me-2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Turnitin
                </a>
                <ul class="dropdown-menu margin-ha" style="background-color: #E9DFEA">
                  <li><a class="dropdown-item">silahkan hubungi admin pada kontak tertera</a></li>
                </ul>
              </li>
            </ul>
          </li>
      </div>
      <p class="fs-5 fw-medium">butuh bantuan admin?</p>
    </div>

    <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    </script> 
    
    

@endsection
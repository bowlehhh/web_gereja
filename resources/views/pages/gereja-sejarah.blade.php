@extends('layout.app')
@section('title','Sejarah - GKKA Samarinda')
@section('content')
@php
  $hero = asset('img/fotogrj.jpeg');
@endphp

<section class="relative overflow-hidden text-white">
  <div class="absolute inset-0">
    <img src="{{ $hero }}" alt="GKKA Samarinda" class="w-full h-full object-cover" onerror="this.onerror=null;this.src='{{ asset('assets/logo.png') }}';">
    <div class="absolute inset-0 bg-blue-950/70 mix-blend-multiply"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-blue-950/75 via-blue-950/35 to-white/0"></div>
  </div>

  <div class="gkka-container relative pt-28 pb-12 sm:pt-32 sm:pb-16">
    <div class="max-w-3xl">
      <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/15 text-blue-100 font-black tracking-widest uppercase text-xs">
        Sejarah
      </div>
      <h1 class="gkka-hero-title mt-6 text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black tracking-tight leading-[1.05]">
        Gereja Kebangunan Kalam Allah Indonesia<br>
        <span class="text-blue-200">Jemaat Samarinda</span>
      </h1>
      <p class="mt-5 text-sm sm:text-base md:text-lg text-blue-100 font-semibold leading-relaxed max-w-2xl">
        Ringkasan perjalanan pelayanan, tokoh, dan tonggak sejarah GKKA Indonesia hingga berdirinya GKKA Indonesia Jemaat Samarinda.
      </p>
    </div>

    <div class="mt-8 flex gap-3 overflow-x-auto pb-2 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
      <a class="gkka-pill shrink-0" href="#ringkas">Ringkasan</a>
      <a class="gkka-pill shrink-0" href="#latar">Latar Belakang</a>
      <a class="gkka-pill shrink-0" href="#cfmu">CFMU</a>
      <a class="gkka-pill shrink-0" href="#sinode">Sinode GKKA</a>
      <a class="gkka-pill shrink-0" href="#samarinda">Jemaat Samarinda</a>
      <a class="gkka-pill shrink-0" href="#dokumen">Dokumen</a>
      <a class="gkka-pill shrink-0" href="#sumber">Sumber</a>
    </div>
  </div>
</section>

<section id="ringkas" class="gkka-section-tight bg-white">
  <div class="gkka-container">
    <div class="grid grid-cols-1 lg:grid-cols-[1.35fr_0.65fr] gap-8 lg:gap-10 items-start">
      <div class="gkka-card gkka-card-pad">
        <div class="flex items-center justify-between gap-4">
          <h2 class="text-2xl sm:text-3xl font-black tracking-tight text-slate-900">Tonggak Penting</h2>
          <span class="hidden sm:inline-flex items-center px-3 py-1.5 rounded-full bg-blue-50 text-blue-800 text-xs font-black tracking-widest uppercase">Ringkas</span>
        </div>
        <div class="mt-6 space-y-4">
          <div class="flex gap-4">
            <div class="shrink-0 w-16">
              <div class="text-xs font-black text-slate-400 uppercase tracking-wider">1843</div>
              <div class="mt-1 w-10 h-1 rounded-full bg-yellow-400"></div>
            </div>
            <div class="text-slate-700 font-semibold leading-relaxed">A.B. Simpson lahir (25 Desember 1843) dan kemudian memulai gerakan penginjilan yang melahirkan C&amp;MA.</div>
          </div>
          <div class="flex gap-4">
            <div class="shrink-0 w-16">
              <div class="text-xs font-black text-slate-400 uppercase tracking-wider">1897</div>
              <div class="mt-1 w-10 h-1 rounded-full bg-yellow-400"></div>
            </div>
            <div class="text-slate-700 font-semibold leading-relaxed">Rev. R.A. Jaffray diutus ke Guangxi, Tiongkok; pelayanan berkembang hingga Asia Tenggara.</div>
          </div>
          <div class="flex gap-4">
            <div class="shrink-0 w-16">
              <div class="text-xs font-black text-slate-400 uppercase tracking-wider">1929</div>
              <div class="mt-1 w-10 h-1 rounded-full bg-yellow-400"></div>
            </div>
            <div class="text-slate-700 font-semibold leading-relaxed">CFMU lahir (26 Maret 1929), mendorong pengutusan misionari Tionghoa ke Asia Tenggara.</div>
          </div>
          <div class="flex gap-4">
            <div class="shrink-0 w-16">
              <div class="text-xs font-black text-slate-400 uppercase tracking-wider">1973</div>
              <div class="mt-1 w-10 h-1 rounded-full bg-yellow-400"></div>
            </div>
            <div class="text-slate-700 font-semibold leading-relaxed">Perubahan nama dan pembentukan Sinode GKKA (12 Mei 1973).</div>
          </div>
          <div class="flex gap-4">
            <div class="shrink-0 w-16">
              <div class="text-xs font-black text-slate-400 uppercase tracking-wider">1981</div>
              <div class="mt-1 w-10 h-1 rounded-full bg-yellow-400"></div>
            </div>
            <div class="text-slate-700 font-semibold leading-relaxed">GKKA Pos PI Samarinda resmi berdiri (21 Agustus 1981).</div>
          </div>
          <div class="flex gap-4">
            <div class="shrink-0 w-16">
              <div class="text-xs font-black text-slate-400 uppercase tracking-wider">1998</div>
              <div class="mt-1 w-10 h-1 rounded-full bg-yellow-400"></div>
            </div>
            <div class="text-slate-700 font-semibold leading-relaxed">IMB gedung gereja terbit (7 Mei 1998) dan ibadah Natal 24 Desember 1998 dipindahkan ke gedung gereja.</div>
          </div>
          <div class="flex gap-4">
            <div class="shrink-0 w-16">
              <div class="text-xs font-black text-slate-400 uppercase tracking-wider">2006</div>
              <div class="mt-1 w-10 h-1 rounded-full bg-yellow-400"></div>
            </div>
            <div class="text-slate-700 font-semibold leading-relaxed">Gedung gereja diresmikan pada HUT ke-25 (21 Agustus 2006).</div>
          </div>
        </div>
      </div>

      <aside class="gkka-card gkka-card-pad bg-slate-50 border-slate-200">
        <div class="text-xs font-black tracking-widest uppercase text-slate-500">Catatan</div>
        <div class="mt-3 text-slate-700 font-semibold leading-relaxed">
          Teks sejarah di bawah ditata ulang agar nyaman dibaca di HP (judul, paragraf, dan bagian panjang dibuat per-bab).
          Jika ada koreksi tanggal/nama/tulisan, kirim revisinya—nanti aku rapikan lagi.
        </div>
        <div class="mt-6 rounded-2xl bg-white border border-slate-200 p-5">
          <div class="text-xs font-black tracking-widest uppercase text-slate-500">Baca Cepat</div>
          <ul class="mt-3 space-y-2 text-sm font-bold text-slate-700">
            <li><a class="hover:text-blue-800 transition-colors" href="#latar">1) Latar belakang GKKA Indonesia</a></li>
            <li><a class="hover:text-blue-800 transition-colors" href="#cfmu">2) CFMU</a></li>
            <li><a class="hover:text-blue-800 transition-colors" href="#sinode">3) Berdirinya Sinode GKKA</a></li>
            <li><a class="hover:text-blue-800 transition-colors" href="#samarinda">4) Berdirinya Jemaat Samarinda</a></li>
          </ul>
        </div>
      </aside>
    </div>
  </div>
</section>

<section class="gkka-section-tight bg-slate-50">
  <div class="gkka-container">
    <div class="grid grid-cols-1 lg:grid-cols-[320px_1fr] gap-8 items-start">

      {{-- Desktop: sidebar TOC (landscape layout) --}}
      <aside class="hidden lg:block sticky top-24">
        <div class="gkka-card gkka-card-pad">
          <div class="text-xs font-black tracking-widest uppercase text-slate-500">Daftar Isi</div>
          <div class="mt-4 space-y-1">
            <a class="block rounded-2xl px-4 py-3 font-bold text-slate-700 hover:bg-slate-50 hover:text-blue-900 transition" href="#ringkas">Ringkasan</a>
            <a class="block rounded-2xl px-4 py-3 font-bold text-slate-700 hover:bg-slate-50 hover:text-blue-900 transition" href="#latar">Latar Belakang</a>
            <a class="block rounded-2xl px-4 py-3 font-bold text-slate-700 hover:bg-slate-50 hover:text-blue-900 transition" href="#cfmu">CFMU</a>
            <a class="block rounded-2xl px-4 py-3 font-bold text-slate-700 hover:bg-slate-50 hover:text-blue-900 transition" href="#sinode">Sinode GKKA</a>
            <a class="block rounded-2xl px-4 py-3 font-bold text-slate-700 hover:bg-slate-50 hover:text-blue-900 transition" href="#samarinda">Jemaat Samarinda</a>
            <a class="block rounded-2xl px-4 py-3 font-bold text-slate-700 hover:bg-slate-50 hover:text-blue-900 transition" href="#dokumen">Dokumen</a>
            <a class="block rounded-2xl px-4 py-3 font-bold text-slate-700 hover:bg-slate-50 hover:text-blue-900 transition" href="#sumber">Sumber</a>
          </div>
        </div>
      </aside>

      {{-- Main content --}}
      <div class="space-y-6">

      <details id="latar" class="gkka-accordion" open>
        <summary>
          <div class="gkka-accordion__summary">
            <div>
              <div class="gkka-accordion__title">Latar Belakang GKKA Indonesia</div>
              <div class="gkka-accordion__meta">Tokoh & awal penginjilan (A.B. Simpson & R.A. Jaffray)</div>
            </div>
            <div class="gkka-accordion__chev" aria-hidden="true">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 15.5 5.5 9l1.4-1.4L12 12.7l5.1-5.1L18.5 9 12 15.5z"/></svg>
            </div>
          </div>
        </summary>
        <div class="gkka-accordion__body">
          <article class="gkka-prose">
            <h2 class="mt-0">SEJARAH</h2>
            <h3 class="mt-4">GEREJA KEBANGUNAN KALAM ALLAH INDONESIA JEMAAT SAMARINDA</h3>

            <h3>LATAR BELAKANG GKKA INDONESIA</h3>
            <p>Gereja Kebangunan Kalam Allah Indonesia (GKKA INDONESIA) tidak lepas dari visi pelayanan dua orang hamba Tuhan, yaitu Albert Benjamin Simpson, pendiri The Christian and Missionary (C&amp;MA) dan Robert Alexander Jaffray (lahir 16 Des 18730, pendiri Chinese Foreign Missionary Union (CFMU). Dua tokoh penting ini merupakan awal berdirinya beberapa gereja di Indonesia, khususnya Gereja Kemah Injil Indonesia (GKII), Persekutuan Kristen (GEPEKRIS), Gereja Kebangunan Kalam Allah Indonesia (GKKA INDONESIA), Gereja Persekutuan Misi Injili Indonesia (GPMII), Gereja Kristen Protestan Bali (GKPB : Tsang To Hang), Gereja Pemberita Injil (GEPEMBRI : Pdt. Jason Stephen Linn, 1948, band. Pdt. Hardi Farianto, 60 Tahun GEREJA PEMBERITA INJIL 1948-2008, hal. 24) dan mungkin masih ada gereja lainnya tidak bisa lepas dari 2 (dua) tokoh besar dalam penginjilan tersebut. Mereka adalah pionir dan pendiri C&amp;MA dan CFMU yang telah mengutus para pionir yang dipakai Tuhan dalam penginjilan yang menghasilkan berdirinya berbagai gereja mulai dari Tiongkok, Vietnam, Thailand sampai Asia tenggara dan Indonesia khususnya.</p>

            <p>A.B. Simpson berasal dari dataran tinggi Skotlandia. Kakeknya bernama James Simpson. Ayahnya bernama James, dan ibunya Jane putrid William Clark. Ia adalah anak ke 4 dari 9 bersaudara yang lahir tanggal 25 Desember 1843 di Kanada. Pada awalnya A.B Simpson melayani di gereja Presbiterian. Di dalam gereja ia melihat bahwa gereja yang mewah tidak peduli terhadap para pengemis, pemabuk, pelacur dan para pengangguran berkeliaran di sekitar gereja. A.B. Simpson yang memiliki visi dan beban penginjilan berusaha menginjili mereka dan beberapa dimenangkan bagi Tuhan. Ketika Simpson mengusulkan kepada pengurus gereja agar menerima 100 orang jadi anggota resmi, usulannya ditolak dengan alasan mereka adalah golongan rendah. Kekecewaan A.B. Simpson terhadap gereja yang sombong dan tak memiliki kasih itu membuat dia memutuskan untuk mengundurkan diri dari keanggotaan gerejanya dan menjadi penginjil lepas. Ia mulai mendirikan Pos Penginjilan dan membawa banyak jiwa kepada Tuhan.</p>

            <p>Dalam tahun ke 8 (delapan) Simpson dan para pengikutnya dapat membangun sebuah tampat permanen sebagai rumah ibadah mereka yang diberi nama: “Tabernakel” atau “Kemah”. A.B.Simpson tidak tertarik pada pembangunan rumah ibadah yang megah seperti pola Salomo, tetapi pada pola Kemah Sembahyang yang didirikan oleh Musa. A.B. Simpson mendirikan 2 (dua) buah rumah ibadah yang disebut “Kemah” dan salah satu di antaranya diberi nama: “The Gospel Tabernacle” atau “Kemah Injil” (Rodger Lewis; Karya Kristus di Indonesia, Sejarah Gereja Kemah Injil Indonesia; Bandung: Kalam Hidup, 2007 hal. 15-18). Untuk mendukung Visi dan panggilannya bagi penginjilan terhadap berbagai suku-bangsa, tahun 1882 A.B.Simpson bersama rekan-rekannya mendirikan sebuah Sekolah Pelatihan Misionary di New York (sekarang dikenal dengan Sekolah Theology Nyack). R.A.Jaffray adalah salah seorang yang mengikuti pendidikan di sekolah tersebut. Pada tahun 1887, A.B.Simpson mendirikan 2 (dua) organisasi Penginjilan, yaitu: The Christian Alliance (Perserikatan Kristen) dan The Evangelical Missionary Alliance (Perserikatan Injili untuk Pengutusan ke Luar Negeri). Tahun 1897 ke dua oraganisasi ini digabung menjadi: “The Christian and Missionary Alliance” (C &amp; M A).</p>

            <p>R.A.Jaffray mendapatkan tantangan dan seruan dari Dr.A.B.Simpson kepada para pemuda untuk menjawab panggilan penginjilan. Saat itu tidak sedikit para pemuda bergetar hatinya untuk menjawab panggilan itu, termasuk R.A Jaffray. R.A. Jaffray mencoba menolaknya, tetapi panggilan pelayanan pemberitaan Injil dalam dirinya semakin hari semakin dalam sehingga ia tidak dapat menolaknya lagi. Ia harus menjadi seorang pemberita Injil. Bagi R.A. Jaffray memberitakan Injil sudah menjadi harga mati. Untuk memperlengkapi diri dalam penginjilan (jadi missionary) R.A.Jaffray mengikuti pendidikan Teologia di Sekolah pelatihan misionaris yang didirikan oleh A.B.Simson di New York Missionary Training Institute.</p>

            <p>Pada tahun 1887 pertama kalinya Dr. A.B Simpson mengunjungi Tiongkok dan Vietnam, ddan tahun 1892 ia kembali mengadakan survei ke provinsi Guangxi. Pada tahun 1897 Dr. A.B. Simpson mengutus Rev. Jaffray bersama 4 orang misionaris beserta seorang dokter (Robert H. Glover yang kemudian jadi misionaris tersohor). Utusan yang pertama itu diutus ke Guangxi di bagian Huanan. Mereka belajar bahasa dan memberitakan Injil. Setelah mereka mereka memahami dan menguasai bahasa daerah masuk ke kota Wuzhou yang waktu itu merpakan pusat perdagangan. Kota ini menjadi markas besar Gereja Kemah Injil di Tiongkok selatan dan menjadi obor kebangunan rohani bagi gereja-gereja di Huanan serta basis pengembangan Penginjilan di Asia Tenggara. (Jason Stephen Linn; DR.R.A.JAFFRAY Pelayanan dan karyanya di China hingga ke Asia Tenggara, Bandung: Kalam Hidup 2010 hal. 40-41).</p>

            <p>Kemudian tahun 1899 lembaga misi The Christian and Missionary Alliance (C&amp;MA) mengutus Rev. Jaffray menetap di Wuzhou. pelayanannya terus berkembang sampai ke seluruh provinsi Guangxi, Virtnam, Thailand, bahkan menerobos Asia Tenggara sampai ke Indonesia dan New Guinea (Jason Stephen Linn; DR.R.A.JAFFRAY Pelayanan dan karyanya di China hingga ke Asia Tenggara, Bandung: Kalam Hidup 2010 hal. 43).</p>

            <p>Pada tahun 1925 Gereja Kemah Injil di Guangxi sangat berkembang. Di seluruh provinsi ada 77 buah gereja, bahkan ada beberapa suku minoritas, seperti suku Yao, suku Dung dan suku Tong telah menerima Injil dan telah ada 50 orang misionari Barat. Pada saat itu Rev.Jaffray menjabat sebagai koordinator/kepala Sekolah Teologi “Alliance Bible Seminary” yang tahun 1950 dipindahkan ke Hongkong (“Alliance Bible Institut” sekarang jadi “Gedung Memorial Jaffray) dan Ketua Perserikatan (sinode) Gereja Kemah Injil Guangxi (gabungan zending dengan gereja Tinghoa setempat). Rev. Jaffray sangat bersemangat dalam penginjilan dan menerapkan empat prinsip, yaitu perkenalan, penginjilan, pengorganisasian dan pembinaan (Jason Stephen Linn; DR.R.A.JAFFRAY Pelayanan dan karyanya di China hingga ke Asia Tenggara, Bandung: Kalam Hidup 2010 hal.48, 59-62).</p>
          </article>
        </div>
      </details>

      <details id="cfmu" class="gkka-accordion">
        <summary>
          <div class="gkka-accordion__summary">
            <div>
              <div class="gkka-accordion__title">Chinese Foreign Missionary Union (CFMU)</div>
              <div class="gkka-accordion__meta">Lembaga misi gereja Tionghoa & pengutusan ke Indonesia</div>
            </div>
            <div class="gkka-accordion__chev" aria-hidden="true">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 15.5 5.5 9l1.4-1.4L12 12.7l5.1-5.1L18.5 9 12 15.5z"/></svg>
            </div>
          </div>
        </summary>
        <div class="gkka-accordion__body">
          <article class="gkka-prose">
            <h2 class="mt-0">CHINESE FOEIGN MISSIONARY UNION (CFMU) LEMBAGA MISI PERTAMA GEREJA TIONGHOA</h2>
            <p>Pada tahun 1921 R.A. Jaffray membawa misionari Tionghoa pertama, Rev. Choe Sing Huen ke Vietnam. Karena di kota Cholon banyak sekali orang Tionghoa, ia memutuskan kota itu menjadi basis pelayanan. Dengan jerih lelah dan perjuangan memberitakan Injil, belasan orang dibawa percaya kepada Kristus. Dalam waktu tidak sampai satu tahun, telah dapat mendirikan gereja di Cholon, Vietnam. Oleh karena kebutuhan perintisan pelayanan di Indonesia pada tahun 1927 Rev. Choe Sing Huen diutus ke Makassar (Indonesia) dan pelayanan di Cholon digantikan oleh Rev. Zheng Ke Lin. Rev. Choe Sing Huen adalah Misionari pertama diutus ke Indonesia. R.A.Jaffray mengharapkan pengalaman Rev. Choe Sing Huen di Cholon dapat diterapkan di Indonesia (hal. 80-81).</p>

            <p>Melihat pelayanan di Asia Tenggara terus berkembang dan tantangan yang makin berat, tahun 1928 Badan Pengurus Pusat Gereja Kemah Injil Guangxi merasa perlu membentuk suatu organisasi lagi agar gereja-gereja Tionghoa ikut menanggung bersama dan menetapkan program untuk perkembangannya. Untuk itu mereka mengadakan rapat dan memilih panitia pembentukan organisasi, yaitu: Rev. Lelang Wang, Rev.Huang Yuan Su, Rev. R.A. Jaffray dan Rev. Zhao Liu Tang. Pada tanggal 26 Maret 1929 Rev. Lelang Wang, Rev. R.A.Jaffray dan Rev. Zhao Liu Tang mengadakan pertemuan di Hongkong, membuat konsep Tata laksana dan membentuk organisasi yang diberi nama “TIM PENGINJILAN ASIA TENGGARA” dan Tanggal tersebut dicatat sebagai tanggal lahirnya CFMU.</p>

            <p>Pada bulan September 1929 Rev. Lelang Wang dan Rev. Paul Rader mengadakan Kebaktian Kebangunan Rohani (KKR) di berbagai kota dan mendapatkan persembahan dana dari anggota jemaat yang mengasihi Tuhan sebesar 600 Yuan yang menjadi dana missi pertama Gereja Tionghoa untuk penginjilan luar negeri (Asia Tenggara). Karena pelayanan yang baru ini dipandang sebagai tugas bersama gereja-gereja Tionghoa, mereka kemudian mengubah nama: “TIM PENGINJILAN ASIA TENGGARA” itu menjadi “CHINESE FOREIGN MISSION UNION (CFMU)” dan menambah seorang lagi sebagai anggota bandan pengurus, yaitu Mr. Wang She. Sejak saat itu lahirlah lembaga misi Gereja Tionghoa yang pertama, yaitu: CHINESE FOREIGN MISSIONARY UNION (CFMU). (Jason Stephen Linn, (terjemahan. Pdt. Tiopilus Bun, M.Min). Dr.R.A. Jaffray Pelayanan dan Karyanya di China hingga Asia Tenggara: Bandung; Kalam Hidup 2010, hal 128-129).</p>

            <p>Rev. Leland Wang menjadi ketua CFMU selama 30 tahun dan mengutus para misionari ke berbagai daerah di Indonesia, periode pertama 11 oang antara lain: Pdt. Choe Sing Huen: Makassar (1928) dan Tarakan, Pdt. Jason S. Linn: Samarinda, Balikpapan dan Kutai Barat mulai dari Bentian (Jason S.Linn dan Paul R.Lenn yang juga dikenal dengan nama C.Y Lam dan K.L.Lin) sebagai utusan Injil pertama di Kalimantan Timur band. Hal. 129-131 dengan Pdt. Rodger Lewis, Karya Kristus di Indonesia Sejarah Gereja Kemah Injil Indonesia Sejak tahun 1930, Bandung: kalam Hidup, 2007. Hal.77).</p>

            <p>Melihat perkembangan pelayanan CFMU di Indonesia, akhir tahun 1972 CFMU menerima surat dari Bimas Kristen Pusat Jakarta yang meminta agar CFMU merubah nama dengan alasan: Pelayanan CFMU di Indonesia sudah lebih 40 tahun dan sudah memiliki lebih dari 30 jemaat dan puluhan ribu anggota, sehingga dianggap wajar lembaga ini diubah dari lembaga misi menjadi lembaga gereja. Oleh karena itu Nama: “CHINESE FOREIGN MISSIONARY UNION” (CFMU: Persekutuan Utusan Injil Tionghoa)” diubah menjadi PERSEKUTUAN PENGINJIL KRISTEN GEREJA-GEREJA CFMU (CHINESE FOREIGN MISSIONARY UNION).</p>
          </article>
        </div>
      </details>

      <details id="sinode" class="gkka-accordion">
        <summary>
          <div class="gkka-accordion__summary">
            <div>
              <div class="gkka-accordion__title">Berdirinya Sinode GKKA Indonesia</div>
              <div class="gkka-accordion__meta">Perubahan nama & pengakuan resmi</div>
            </div>
            <div class="gkka-accordion__chev" aria-hidden="true">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 15.5 5.5 9l1.4-1.4L12 12.7l5.1-5.1L18.5 9 12 15.5z"/></svg>
            </div>
          </div>
        </summary>
	        <div class="gkka-accordion__body">
	          <article class="gkka-prose">
            <h2 class="mt-0">BERDIRINYA SINODE GEREJA KEBANGUNAN KALAM ALLAH INDONESIA</h2>
            <p>Pada tanggal 11-13 Mei 1973 para wakil gereja-gereja yang tergabung dalam PERSEKUTUAN PENGINJIL KRISTEN GEREJA-GEREJA CFMU (CHINESE FOREIGN MISSIONARY UNION) mengadakan Persidangan Sinode I (pertama) di Surabaya, tepatnya pada tanggal 12 Mei 1973 memutuskan perubahan nama dari PERSEKUTUAN PENGINJIL KRISTEN GEREJA-GEREJA CFMU menjadi SINODE GEREJA KEBANGUNAN KALAM ALLAH. (Band. Akte Notaris Mr. OE SIANG DJIE No. 47, tanggal 19 Mei 1973 dan Akte Notaris SOETJIPTO SH, tanggal 24 April 1989 No. 185).</p>

            <p>Dalam hubungan dengan gereja yang Esa dan Oikoumenis, pada tanggal 28 Oktober 1984 SINODE GEREJA KEBANGUNAN KALAM ALLAH terdaftar menjadi anggota ke 53 Persekutuan Gereja-gereja di Indonesia (PGI).</p>

            <p>Pada tanggal 26 Juni 1987 dalam Sidang Raya ke V di Malino Sulawesi Selatan, ditetapkan perubahan Tata Dasar &amp; Tata Laksana serta pengembangan nama GEREJA KEBANGUNAN KALAM ALLAH (GKKA) menjadi GEREJA KEBANGUNAN KALAM ALLAH INDONESIA disingkat GKKA INDONESIA dan terdaftar sah sebagai lembaga keagamaan dengan Surat Keputusan Direktorat Jenderal Bimbingan Masyarakat (S.K. Dirjen Bimas) Kristen Departemen Agama Republik Indonesia Nomor : 122 tanggal 21 Juli 1990.</p>
	          </article>
	        </div>
	      </details>

	      <details id="samarinda" class="gkka-accordion">
        <summary>
          <div class="gkka-accordion__summary">
            <div>
              <div class="gkka-accordion__title">Berdirinya GKKA Indonesia Jemaat Samarinda</div>
              <div class="gkka-accordion__meta">Perintisan, tantangan, pembangunan gedung, dan pertumbuhan</div>
            </div>
            <div class="gkka-accordion__chev" aria-hidden="true">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 15.5 5.5 9l1.4-1.4L12 12.7l5.1-5.1L18.5 9 12 15.5z"/></svg>
            </div>
          </div>
        </summary>
        <div class="gkka-accordion__body">
          <article class="gkka-prose">
            <h2 class="mt-0">BERDIRINYA GKKA INDONESIA JEMAAT SAMARINDA</h2>
            <p>Sejalan dengan perkembangan pembangunan ekonomi dan pendidikan di Kalimantan Timur, beberapa keluarga dari jemaat Gereja Kebangunan Kalam Allah (GKKA) asal Kabupaten Kutai Barat (dulu disebut pedalaman Damai dan Sekitarnya: meliputi Kecamatan Bentian Besar, Muara Lawa, Kecamatan Damai dan Kecamatan Barong Tongkok) mulai bekerja dan berdomisili di Samarinda. Demikian juga pemuda/I semakin banyak yang melanjutkan pendidikan di Samarinda. Beberapa keluarga jemaat yang telah bekerja di Samarinda digerakkan oleh Roh Kudus untuk menghimpun anggota jemaat dan para pelajar &amp; mahasiswa asal pedalaman (Kutai Barat) dalam suatu wadah persekutuan/gereja.</p>

            <h3>Perintisan (1980–1981)</h3>
            <p>Sekitar akhir Npvember 1980 Roh Kudus menggerakkana beberapa anggota jemaat yang ada untuk mengadakan rapat di rumah bapak Daud Wilson di Jl. R.E. Martadinata Gang Raudah. Rapat tersebut dihadiri oleh Bpk. Daud Wilson, Bpk. Usman Rampan, Bpk. R.I Gamas, Bpk. Muchtar Hidayat, Bpk. Matius Mentik, Bpk. Johanes Gadak, Bpk. Aman Anton, Bpk. Gustaf AA (Selimin), Bpk. Ganiansyah dan beberapa orang lainnya.</p>

            <p>Rapat tersebut menyepakati dua hal penting yaitu: sepakat mendirikan GKKA Pos PI Samarinda dan terbentuknya kepengurusan/kemajelisan yang pertama.</p>

            <div class="mt-6 rounded-3xl border border-slate-200 bg-slate-50 p-6">
              <div class="text-xs font-black tracking-widest uppercase text-slate-500">Kemajelisan Pertama</div>
              <ul class="mt-3 space-y-2 text-sm font-bold text-slate-700">
                <li>Ketua: Muchtar Hidyat, Bc.Hk</li>
                <li>Wakil Ketua: Johanes Gadak</li>
                <li>Sekretaris: Matius Mentik</li>
                <li>Bendahara: Ganiansyah (Gani)</li>
                <li>Pembantu Umum: Aman Anton</li>
              </ul>
            </div>

            <p>Dua minggu setelah terbentuknya kepengurusan tersebut, mulai dilaksanakan kebaktian setiap hari minggu di rumah bapak Muchtar Hidayat di Jalan Lambung Mangkurat. Karena belum ada hamba Tuhan tetap, ibadah dari awal hingga pertengahan tahun 1981 dilayani oleh ketua majelis sendiri dan sewaktu-waktu dilayani oleh Pdt. Yulius Siaw, Pdt. Yosua Darwis (alm) dan hamba-hamba Tuhan dari gereja seazas seperti Pdt. Daniel Assad (GKII) dan Pdt. Petrus Pallobo (Gereja KIBAID). Jumlah kehadiran rata-rata, 30 orang, termasuk para simpatisan.</p>

            <p>Syukur pada Tuhan, pada bulan Agustus tahun 1981 tempat ibadah dipindahkan ke salah satu ruangan kecil di belakang gedung Mulia Budi (Christian Centre) Jl. Kebaktian No. 150 (Sekarang: Jl. Urip Sumoharjo). Setelah ibadah berjalan dengan baik di Mulia Budi, keadaan jemaat dilaporkan kepada Sinode GKKA dan Team Pengembangan Karya Tuhan (TPKT), dan atas anugerah Tuhan Yesus Kristus, pada tanggal 21 Agustus 1981 Gereja kebangunan Kalam Allah (GKKA) Pos PI Samarinda resmi berdiri.</p>

            <h3>Menghadapi tantangan dan hambatan</h3>
            <p>Bedirinya GKKA Pos PI Samarinda tidak lepas dari berbagai tantangan, hambatan dan pergumulan, antara lain di bidang daya, dana dan pembangunan sarana/ tempat ibadah (gereja).</p>

            <h3>Pembangunan Gedung Gereja</h3>
            <p>Sejak berdirinya GKKA Pos PI Samarinda, jemaat merindukan rumah ibadah (gedung gereja) milik sendiri untuk tempat ibadah tetap. Melalui pergumulan, doa jemaat dan lewat usaha Team Pengembangan Karya Tuhan (Ibu Dewi Eden Gunawan) Tuhan mengaruniakan sebidang tanah di Jl. Juanda I dengan luas 2000 m2.</p>

            @php
              $galeriSejarah = [
                [
                  'src' => asset('img/sejarah/batu-pertama.jpg'),
                  'title' => 'Peletakan Batu Pertama',
                  'meta' => '13 Juli 1997',
                ],
                [
                  'src' => asset('img/sejarah/pembangunan-gedung.jpg'),
                  'title' => 'Masa Pembangunan Gedung',
                  'meta' => 'Jl. Sentosa, Samarinda',
                ],
                [
                  'src' => asset('img/sejarah/foto-bersama.jpg'),
                  'title' => 'Kebersamaan Jemaat',
                  'meta' => 'Dokumentasi Sejarah',
                ],
              ];
            @endphp

            <div class="mt-8">
              <div class="flex items-end justify-between gap-4">
                <div>
                  <div class="text-xs font-black tracking-widest uppercase text-slate-500">Galeri</div>
                  <h4 class="mt-1 text-xl sm:text-2xl font-black tracking-tight text-slate-900">Dokumentasi Pembangunan</h4>
                </div>
                <div class="hidden sm:block text-xs font-bold text-slate-500">Klik foto untuk memperbesar</div>
              </div>

              <div class="mt-4 flex gap-4 overflow-x-auto pb-2 snap-x snap-mandatory [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden sm:grid sm:grid-cols-3 sm:overflow-visible sm:pb-0">
                @foreach($galeriSejarah as $g)
                  <a href="{{ $g['src'] }}" target="_blank" rel="noopener"
                     class="group snap-start min-w-[88%] sm:min-w-0">
                    <div class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm hover:shadow-lg transition-shadow">
                      <div class="aspect-[16/11] bg-slate-100 overflow-hidden">
                        <img
                          src="{{ $g['src'] }}"
                          alt="{{ $g['title'] }}"
                          loading="lazy"
                          class="w-full h-full object-cover transition duration-700 group-hover:scale-105"
                          onerror="this.onerror=null;this.src='{{ asset('assets/logo.png') }}';"
                        >
                      </div>
                      <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/10 to-transparent"></div>
                      <div class="absolute bottom-0 left-0 w-full p-5 text-white">
                        <div class="text-[11px] font-black tracking-widest uppercase text-white/80">{{ $g['meta'] }}</div>
                        <div class="mt-1 font-black text-lg leading-snug">{{ $g['title'] }}</div>
                      </div>
                    </div>
                  </a>
                @endforeach
              </div>
            </div>

            <p>Panitia pembangunan gereja dibentuk dengan ketua Bpk. Daud Wilson, S.H. Panitia pembangunan berusaha mengurus Ijin Pembangunan gereja di Jalan Juanda I, tetapi mengalami banyak hambatan dan tantangan hingga IMB tidak kunjung diperoleh. Tahun 1988 majelis dan jemaat membenahi kepanitiaan dan terpilih sebagai ketua, yaitu Bpk. Madran dan Bpk. Hendri Mozes.</p>

            <p>Pada tanggal 5 Januari 1991 tanah di Jl. Juanda I dapat dijual kepada Bp. Andas seharga Rp. 51.250.000. Setelah melalui proses mencari lokasi baru, pada tahun 1995 tanah di jalan Sentosa dapat dibeli seluas sekitar 1.300 m2 dengan harga Rp. 29.250.000.</p>

            <p>Pada tanggal 13 Juli 1997 dengan iman dilaksanakan Peletakan Batu Pertama oleh Pdt. Mark Silas, M.Div selaku ketua MPH GKKA INDONESIA. Pada tanggal 7 Mei 1998 Bp.Lukhman Said selaku Walikota Samarinda menerbitkan IMB gedung GKKA INDONDONESIA.</p>

            <p>Walau daya dan dana terbatas, pembangunan gedung gereja tetap berjalan. Tepat pada Natal tanggal 24 Desember 1998 ibadah dipindahkan dari Chapel Mulia Budi ke Gedung gereja yang dimulai dengan perayaan natal jemaat.</p>

            <p>Dalam waktu 8 tahun (1998-2006), dengan segala anugerah-Nya, kebersamaan dan dukungan semua anggota jemaat, pembangunan gereja dapat diselesaikan dengan ukuran 10 X 24 meter dua lantai dan di HUT yang ke 25 gedung GKKA INDONESIA Jemaat Samarinda diresmikan pada tanggal 21 Agustus 2006.</p>

            <h3>Pertumbuhan Jemaat</h3>
            <p>Pertumbuhan gereja tidak lepas dari adanya hamba Tuhan, adanya diaken/pengurus jemaat yang memberikan hati, jiwa dan seluruh hidupnya untuk melayanai Tuhan, serta jemaat yang mengasihi dan mencintai Tuhan.</p>

            <h3>Hamba Tuhan yang Melayani (ringkas)</h3>
            <ul>
              <li>Ev. Anton dan Ev. Jhoni Silan (praktek SAAT, 1981-1982)</li>
              <li>Ev. Yehezkiel Kiuk (I3, 1982-1983)</li>
              <li>Ev. Panulis Saguntung (I3, 1983-1984)</li>
              <li>Ev. Adrianus Amacoten (I3, 1984-1985)</li>
              <li>Ev. Saul Simatupang (I3, 1985-1986; kembali melayani 17 Agustus 1988 – Agustus 2011)</li>
              <li>Ev. Ruslan B.Th (1986–1988)</li>
              <li>Pdt. Johanes Markus Djukuw</li>
              <li>Ev. Esther Netty Markus (ditahbiskan 20 Agustus 2011)</li>
              <li>Pdt. Nely Susanti (kembali melayani 2007; ditahbiskan 31 Oktober 2015)</li>
            </ul>

            <h3>Diaken (Ketua Majelis) (ringkas)</h3>
            <ul>
              <li>Bp. Muchtar Hidayat (1980–1982; 1985–1987)</li>
              <li>Bp. Johanes M. Djukuw (1982–1985)</li>
              <li>Bp. Madran (1987–1989)</li>
              <li>Drs. Nikodemus Duit (1989–1991)</li>
              <li>Bp. Samuel Berling, B.A. (1991–1995)</li>
              <li>Bp. Andy BCA (1995–1999; 2002–2003)</li>
              <li>Bp. Andrianus Sengkoi (1999–2001; 2004–2005; 2010–2015)</li>
              <li>Ny. Ruth Elmiyati (2006–2009)</li>
            </ul>

            <h3>Apa yang harus dilakukan untuk perkembangan ke depan (ringkas)</h3>
            <p>Dalam merencanakan pertumbuhan gereja ke depan, gereja berpedoman pada Tri Tugas panggilan gereja: Koinonia, Marturia, dan Diakonia, serta berpegang pada Visi–Misi untuk menjadi gereja yang sehat dan bertumbuh sebagai terang bagi masyarakat.</p>
          </article>
        </div>
      </details>

      <details id="sumber" class="gkka-accordion">
        <summary>
          <div class="gkka-accordion__summary">
            <div>
              <div class="gkka-accordion__title">Sumber Referensi</div>
              <div class="gkka-accordion__meta">Daftar rujukan yang disebut di dokumen</div>
            </div>
            <div class="gkka-accordion__chev" aria-hidden="true">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 15.5 5.5 9l1.4-1.4L12 12.7l5.1-5.1L18.5 9 12 15.5z"/></svg>
            </div>
          </div>
        </summary>
        <div class="gkka-accordion__body">
          <article class="gkka-prose">
            <h2 class="mt-0">Sumber</h2>
            <ul>
              <li>A.E. Thompson, A.B. Simson Pelayanan dan Karyanya, Bandung: Kalam Hidup, 2009.</li>
              <li>A.W. Tozer; Biarkan Umatku pergi, Bandung: Kalam Hidup, 1994.</li>
              <li>Rodger Lewis; Karya Kristus di Indonesia, Sejarah Gereja Kemah Injil Indonesia; Bandung: Kalam Hidup, 2007.</li>
              <li>Pdt. Hardi Farianto, 60 Tahun GEREJA PEMBERITA INJIL 1948-2008.</li>
              <li>Jason Stephen Linn; DR.R.A.JAFFRAY Pelayanan dan karyanya di China hingga ke Asia Tenggara, Bandung: Kalam Hidup 2010.</li>
              <li>Sejarah Pekabaran Indjili Selama 30 tahun dari Persekutuan Utusan Indjili Tionghoa (Chinese Foreign Missionary Union) 1929-1959.</li>
              <li>Sejarah 70 tahun CFMU.</li>
              <li>Anggaran Dasar THE CHINESE FOREIGN MISSIONARY UNION di SURABAJA, 1953.</li>
              <li>TATA GEREJA SINODE Gereja Kebangunan Kalam Allah (GKKA), disahkan pada Sidang Sinode bulan Maret 1979.</li>
              <li>Tata Dasar dan Tata Laksana GKKA Indonesia, disahkan dalam Sidang Raya 26 Juni 1987.</li>
            </ul>
          </article>
        </div>
      </details>

      @php
        $sejarahLengkap = <<<'TEXT'
SEJARAH
GEREJA KEBANGUNAN KALAM ALLAH INDONESIA JEMAAT SAMARINDA

LATAR BELAKANG GKKA INDONESIA

Gereja Kebangunan Kalam Allah Indonesia (GKKA INDONESIA) tidak lepas dari visi pelayanan dua orang hamba Tuhan, yaitu Albert Benjamin Simpson, pendiri The Christian and Missionary (C&MA)  dan Robert Alexander Jaffray (lahir 16 Des 18730,  pendiri   Chinese Foreign Missionary Union (CFMU).  Dua tokoh penting  ini merupakan awal  berdirinya beberapa gereja di Indonesia, khususnya Gereja Kemah Injil Indonesia (GKII),  Persekutuan  Kristen (GEPEKRIS),  Gereja Kebangunan Kalam Allah Indonesia (GKKA INDONESIA), Gereja Persekutuan Misi Injili Indonesia (GPMII), Gereja Kristen Protestan Bali (GKPB : Tsang To Hang),  Gereja Pemberita Injil (GEPEMBRI : Pdt. Jason Stephen Linn, 1948, band. Pdt. Hardi Farianto, 60 Tahun GEREJA PEMBERITA INJIL 1948-2008, hal. 24) dan mungkin masih ada gereja lainnya tidak bisa lepas dari 2 (dua ) tokoh besar dalam penginjilan tersebut.   Mereka adalah pionir dan pendiri C&MA dan CFMU yang telah mengutus para pionir  yang dipakai Tuhan dalam penginjilan yang menghasilkan berdirinya berbagai gereja mulai dari Tiongkok, Vietnam, Thailand sampai Asia tenggara dan Indonesia khususnya.

A.B. Simpson berasal dari dataran tinggi Skotlandia.  Kakeknya bernama James Simpson. Ayahnya bernama James, dan ibunya Jane putrid William Clark. Ia adalah anak ke 4 dari 9 bersaudara yang lahir tanggal 25 Desember 1843 di Kanada. Pada awalnya A.B Simpson melayani di gereja Presbiterian. Di dalam gereja ia melihat bahwa gereja yang mewah tidak peduli terhadap para pengemis, pemabuk, pelacur dan para pengangguran berkeliaran di sekitar gereja.  A.B. Simpson yang memiliki visi dan beban penginjilan berusaha menginjili mereka dan beberapa dimenangkan bagi Tuhan.  Ketika Simpson mengusulkan kepada pengurus gereja agar menerima 100 orang jadi anggota resmi, usulannya ditolak dengan alasan mereka adalah golongan rendah.  Kekecewaan A.B. Simpson terhadap gereja yang sombong dan tak memiliki kasih itu membuat dia memutuskan untuk mengundurkan diri dari keanggotaan gerejanya dan menjadi penginjil lepas.  Ia mulai mendirikan Pos Penginjilan dan membawa banyak jiwa kepada Tuhan.

Dalam tahun ke 8 (delapan) Simpson dan para pengikutnya dapat membangun sebuah tampat permanen sebagai rumah ibadah mereka yang diberi nama: “Tabernakel” atau “Kemah”.   A.B.Simpson tidak tertarik pada pembangunan rumah ibadah yang megah seperti pola Salomo, tetapi pada pola Kemah Sembahyang yang didirikan oleh Musa.   A.B. Simpson mendirikan 2 (dua) buah rumah ibadah yang disebut “Kemah” dan salah satu di antaranya diberi nama: “The Gospel Tabernacle” atau “Kemah Injil” (Rodger Lewis; Karya Kristus di Indonesia, Sejarah Gereja Kemah Injil Indonesia; Bandung: Kalam Hidup, 2007 hal. 15-18). Untuk mendukung Visi dan panggilannya bagi penginjilan terhadap berbagai suku-bangsa, tahun 1882 A.B.Simpson bersama rekan-rekannya mendirikan sebuah Sekolah Pelatihan Misionary di New York (sekarang dikenal dengan Sekolah Theology Nyack). R.A.Jaffray adalah salah seorang yang mengikuti pendidikan di sekolah tersebut.  Pada tahun 1887, A.B.Simpson mendirikan 2 (dua) organisasi Penginjilan, yaitu: The Christian Alliance (Perserikatan Kristen) dan The Evangelical Missionary Alliance (Perserikatan Injili untuk Pengutusan ke Luar Negeri).  Tahun 1897 ke dua oraganisasi ini digabung menjadi:  “The Christian and Missionary Alliance” (C & M A).

R.A.Jaffray mendapatkan tantangan dan seruan dari Dr.A.B.Simpson kepada para pemuda untuk menjawab panggilan penginjilan.  Saat itu tidak sedikit para pemuda bergetar hatinya untuk menjawab panggilan itu, termasuk R.A Jaffray.   R.A. Jaffray mencoba menolaknya, tetapi panggilan pelayanan pemberitaan Injil dalam dirinya semakin hari semakin dalam sehingga ia tidak dapat menolaknya lagi.  Ia harus menjadi seorang pemberita Injil.  Bagi R.A. Jaffray memberitakan Injil sudah menjadi harga mati.  Untuk memperlengkapi diri dalam penginjilan (jadi missionary) R.A.Jaffray mengikuti pendidikan Teologia di Sekolah pelatihan misionaris yang didirikan oleh A.B.Simson di New York Missionary Training Institute.

Pada tahun 1887 pertama kalinya Dr. A.B Simpson mengunjungi Tiongkok dan Vietnam, ddan tahun 1892 ia kembali mengadakan survei ke provinsi Guangxi. Pada tahun 1897 Dr. A.B. Simpson mengutus Rev. Jaffray bersama 4 orang misionaris beserta seorang dokter (Robert H. Glover yang kemudian jadi misionaris tersohor). Utusan yang pertama itu diutus ke Guangxi di bagian Huanan. Mereka belajar bahasa dan memberitakan Injil. Setelah mereka mereka memahami dan menguasai bahasa daerah masuk ke kota Wuzhou yang waktu itu merpakan pusat perdagangan. Kota ini menjadi markas besar Gereja Kemah Injil di Tiongkok selatan dan menjadi obor kebangunan rohani bagi gereja-gereja di Huanan serta basis pengembangan Penginjilan di Asia Tenggara.  (Jason Stephen Linn; DR.R.A.JAFFRAY Pelayanan dan karyanya di China hingga ke Asia Tenggara, Bandung: Kalam Hidup 2010 hal.  40-41).

Kemudian tahun 1899 lembaga misi The Christian and Missionary Alliance (C&MA) mengutus Rev. Jaffray menetap di  Wuzhou.  pelayanannya terus berkembang sampai ke  seluruh provinsi Guangxi, Virtnam, Thailand, bahkan menerobos  Asia Tenggara sampai ke Indonesia dan New Guinea  (Jason Stephen Linn; DR.R.A.JAFFRAY Pelayanan dan karyanya di China hingga ke Asia Tenggara, Bandung: Kalam Hidup 2010 hal.  43).

Pada tahun 1925 Gereja Kemah Injil di Guangxi sangat berkembang. Di seluruh provinsi ada 77 buah gereja, bahkan ada beberapa suku minoritas, seperti suku Yao, suku Dung dan suku Tong telah menerima Injil dan telah ada 50 orang misionari Barat.   Pada saat itu Rev.Jaffray menjabat sebagai koordinator/kepala Sekolah Teologi “Alliance Bible Seminary” yang tahun 1950 dipindahkan ke Hongkong (“Alliance Bible Institut” sekarang jadi “Gedung Memorial Jaffray) dan Ketua Perserikatan (sinode) Gereja Kemah Injil Guangxi (gabungan zending dengan gereja Tinghoa setempat).  Rev. Jaffray sangat bersemangat dalam penginjilan dan menerapkan empat prinsip, yaitu perkenalan, penginjilan, pengorganisasian dan pembinaan (Jason Stephen Linn; DR.R.A.JAFFRAY Pelayanan dan karyanya di China hingga ke Asia Tenggara, Bandung: Kalam Hidup 2010hal.48, 59-62).

CHINESE FOEIGN MISSIONARY UNION (CFMU) LEMBAGA MISI PERTAMA GEREJA TIONGHOA

Pada tahun 1921 R.A. Jaffray membawa misionari Tionghoa pertama, Rev. Choe Sing Huen ke Vietnam.  Karena di kota Cholon banyak sekali orang Tionghoa, ia memutuskan kota itu menjadi basis pelayanan.  Dengan jerih lelah dan perjuangan memberitakan Injil, belasan orang dibawa percaya kepada Kristus.  Dalam waktu tidak sampai satu tahun, telah dapat mendirikan gereja di Cholon, Vietnam.   Oleh karena kebutuhan perintisan pelayanan di Indonesia pada tahun 1927 Rev. Choe Sing Huen diutus ke Makassar (Indonesia) dan pelayanan di Cholon digantikan oleh Rev. Zheng Ke Lin. Rev. Choe Sing Huen adalah Misionari pertama diutus ke Indonesia.  R.A.Jaffray mengharapkan pengalaman Rev. Choe Sing Huen di Cholon dapat diterapkan di Indonesia (hal. 80-81). Selain dari Rev. Choe Sing Huen, R.A.Jaffray juga mengajak teman-temannya melayani di berbagai daerah di Asia tenggara termasuk di Indonesia, anatara lain Rev. Zhao Liu Tang (Ketua Perserikatan Gereja Tionghoa Kemah Injil Guangxi) mengunjungi wilayah Hindia Belanda untuk melayani Kebaktian Kebangunan Rohani. Melihat pelayanan di Asia Tenggara terus berkembang dan tantangan yang makin berat, tahun 1928 Badan Pengurus Pusat Gereja Kemah Injil Guangxi merasa perlu membentuk suatu organisasi lagi agar gereja-gereja  Tionghoa ikut menanggung bersama dan menetapkan program untuk perkembangannya. Untuk itu mereka mengadakan rapat dan memilih panitia pembentukan organisasi, yaitu: Rev. Lelang Wang, Rev.Huang Yuan Su, Rev.  R.A. Jaffray dan Rev. Zhao Liu Tang.  Pada tanggal 26  Maret 1929 Rev. Lelang Wang, Rev. R.A.Jaffray dan Rev. Zhao Liu Tang mengadakan pertemuan di Hongkong, membuat konsep Tata laksana dan membentuk organisasi yang diberi nama “TIM PENGINJILAN ASIA TENGGARA” dan Tanggal tersebut dicatat sebagai tanggal lahirnya CFMU.  Pada bulan Agustus 1929  Badan Pengurus Pusat Sinode Gereja Kemah Injil  Guangxi  mengadakan Sidang dan secara resmi membentuk Badan Pengurus dan memilih 7 orang pengurus TIM PENGINJILAN ASIA TENGGARA, yaitu : Rev. Lelang Wang, Rev. Huang Yuan Wu, Rev.R.A.Jaffray, Rev. Zhao Liu Tang, Rev. Liang Xi Gao, Rev. Wu Ji Hua dan Rev. William Newbern.  Kemudian sidang tersebut menetapkan susunan pengurus: Rev. Lelang Wang sebagai ketua, Rev.R.A. Jaffray sebagai wakil ketua dan bendahara, dan Rev. Liang Xi Gao sebagai Sekretaris dan berkantor di Wuzhou, Guangxi.

Pada bulan September 1929 Rev. Lelang Wang dan Rev. Paul Rader mengadakan Kebaktian Kebangunan Rohani (KKR) di berbagai kota dan mendapatkan persembahan dana dari anggota jemaat yang mengasihi Tuhan sebesar 600 Yuan yang menjadi dana missi pertama Gereja Tionghoa untuk penginjilan luar negeri (Asia Tenggara).   Karena pelayanan yang baru ini dipandang sebagai tugas bersama gereja-gereja Tionghoa, mereka kemudian mengubah nama: “TIM PENGINJILAN ASIA TENGGARA” itu menjadi “CHINESE FOREIGN MISSION UNION (CFMU)” dan menambah seorang lagi sebagai anggota bandan pengurus, yaitu Mr. Wang She.  Sejak saat itu lahirlah lembaga misi Gereja Tionghoa yang pertama, yaitu: CHINESE FOREIGN MISSIONARY UNION (CFMU).   (Jason Stephen Linn, (terjemahan. Pdt. Tiopilus Bun, M.Min). Dr.R.A. Jaffray Pelayanan dan Karyanya di China hingga Asia Tenggara: Bandung; Kalam Hidup 2010, hal 128-129).

Rev. Leland Wang menjadi ketua CFMU selama 30 tahun dan mengutus para misionari ke berbagai daerah di Indonesia, periode pertama 11 oang antara lain: Pdt. Choe Sing Huen: Makassar (1928) dan Tarakan, Pdt. Jason S. Linn: Samarinda, Balikpapan  dan Kutai Barat mulai dari Bentian  (Jason S.Linn dan Paul R.Lenn yang juga dikenal dengan nama C.Y Lam dan K.L.Lin) sebagai utusan Injil pertama di Kalimantan Timur band. Hal. 129-131 dengan Pdt. Rodger Lewis, Karya Kristus di Indonesia Sejarah Gereja Kemah Injil Indonesia Sejak tahun 1930, Bandung: kalam Hidup, 2007. Hal.77). Pdt. Lien Kwang Ling: Samarinda, Balikpapan dan Kutai Barat (band. Hal. 129-131 dengan), Pdt. Tsang To Hang: Bali (GKPB) dll. Kemudian periode ke dua: Pdt. James Timothy Chan: Samarinda, Pdt. Chang Shih Ying: Kutai Barat, Pdt. C.Y.Wong: Bangka Belitung dll (GEPEKRIS). (band. Tiga Sinode Ex. CFMU: Sejarah 70 Tahun CFMU, hal. 17).  Sementara itu Rev. Jaffray mendukung dua badan misi, yaitu:  menjadi pendiri dan pengurus Chinese Foreign Missionary Union (CFMU), dan  juga sebagai utusan The Christian and Missionary Alliance (C&MA), yaitu pendiri Gereja Kemah Injil Indonesia.  Pada bulan September 1930 Jaffray pindah ke Makassar dan menjadikan rumah tinggalnya di Daeng Tompo Straat 8 menjadi kantor pusat C&MA/Gereja Kemah Injil Indonesia yang pertama. Dari tempat ini Jaffray mengembangkan pelayanannya yang kemudian berkembang ke berbagai daerah di Indonesia.   Ada tiga hal yang diutamakan Rev. Jaffray yang sangat menunjang keberhasilan pelayanannya, yaitu: penerbitan (Kalam Hidup/Bible Magazine), pendidikan dan gereja pusat (band. Pdt. Rodger Lewis, Karya Kristus di Indonesia Sejarah Gereja Kemah Injil Indonesia Sejak tahun 1930, Bandung: kalam Hidup, 2007. Hal.26-29).

TEXT;
        $paragraf = array_values(array_filter(preg_split("/\\R{2,}/", trim($sejarahLengkap)) ?: []));
      @endphp

      <details id="dokumen" class="gkka-accordion">
        <summary>
          <div class="gkka-accordion__summary">
            <div>
              <div class="gkka-accordion__title">Dokumen Sejarah (Teks)</div>
              <div class="gkka-accordion__meta">Versi teks untuk arsip (bagian awal)</div>
            </div>
            <div class="gkka-accordion__chev" aria-hidden="true">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 15.5 5.5 9l1.4-1.4L12 12.7l5.1-5.1L18.5 9 12 15.5z"/></svg>
            </div>
          </div>
        </summary>
        <div class="gkka-accordion__body">
          <article class="gkka-prose">
            <h2 class="mt-0">Teks Dokumen</h2>
            @foreach($paragraf as $p)
              <p>{{ $p }}</p>
            @endforeach
          </article>
        </div>
      </details>

      </div>
    </div>
  </div>
</section>
@endsection

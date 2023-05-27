@extends('layouts.app-public')

@section('content')
  <div class="s-hero">
    <div class="container" style="padding: 10em 1em">
      <div class="row">
        <div class="col-xl-6 z-index-1 text-white">
          <h2 class="mb-0 text-center mb-4 text-white">
            {{ $option('greeting', 'Selamat datang di Profil SMA 72 Jakarta Selatan!') }}
          </h2>
          <div class="text-center lead">
            {{ $option('vission-mission', 'Visi kami adalah menjadi sekolah yang unggul dalam pengembangan potensi siswa, menciptakan pemimpin masa depan yang kompeten, berintegritas, dan berkepribadian unggul. Di SMA 72 Jakarta Selatan, kami berkomitmen untuk memberikan pendidikan yang holistik dan berkualitas tinggi guna mempersiapkan siswa kami untuk menghadapi tantangan global.') }}
          </div>
        </div>
      </div>
      <div class="s-backdrop"></div>
    </div>
  </div>

  <div class="container" style="padding: 8em">
    <div class="text-center">
      <h2>{{ $option('profile-title', 'Profil Sekolah:') }}</h2>
      <div class="lead">
        {{ $option('profile-body', 'SMA 72 Jakarta Selatan merupakan salah satu sekolah menengah atas yang terkemuka di daerah ini. Sejak didirikan pada tahun 1995, kami telah memberikan pendidikan yang berkualitas dan berhasil mencetak lulusan yang sukses di berbagai bidang. Dengan bangunan yang modern dan fasilitas yang lengkap, kami menciptakan lingkungan belajar yang inspiratif dan nyaman bagi siswa kami.') }}
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-xl-5">
        <img width="100%" src="{{ $option('curriculum-image', url('/assets/images/template-1/curriculum.jpg')) }}"
          alt="">
      </div>
      <div class="col-xl-7" style="padding: 0 6em">
        <h2>{{ $option('curriculum-title', 'Kurikulum:') }}</h2>
        <div class="lead">
          {{ $option('curriculum-body', 'Kami menerapkan kurikulum yang komprehensif dan berstandar nasional untuk memastikan keselarasan dengan kurikulum pendidikan nasional. Selain itu, kami juga menawarkan program-program ekstrakurikuler yang beragam, termasuk klub sains, seni, olahraga, dan kegiatan sosial. Hal ini bertujuan untuk memperkaya pengalaman belajar siswa, mengembangkan minat dan bakat mereka, serta membantu mereka dalam mengembangkan keterampilan sosial dan kepemimpinan.') }}
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-3 mt-8">
    <div class="row">
      <div class="col-xl-6 p-4">
        <h2>{{ $option('facility-title', 'Fasilitas:') }}</h2>
        <div class="lead">
          {{ $option('facility-body', 'Kami memiliki fasilitas modern yang mendukung proses pembelajaran yang efektif. Ruang kelas dilengkapi dengan peralatan multimedia, laboratorium ilmiah yang lengkap, perpustakaan yang kaya akan koleksi buku, serta aula dan lapangan olahraga. Semua ini dirancang untuk menciptakan lingkungan belajar yang optimal bagi siswa kami.') }}
        </div>
      </div>
      <div class="col-xl-6">
        <img width="100%" src="{{ $option('facility-image', url('/assets/images/template-1/facility.jpg')) }}"
          alt="">
      </div>
    </div>
  </div>


  <div class="container pt-9">
    <div class="text-center">
      <h2>{{ $option('teachers-title', 'Tenaga Pendidik:') }}</h2>
      <div class="lead">
        {{ $option('teachers-body', 'Kami memiliki tim pengajar yang berkualitas, berdedikasi, dan berpengalaman. Guru-guru kami terus mengikuti pelatihan dan pengembangan profesional untuk memberikan pengajaran terbaik kepada siswa. Mereka tidak hanya berfokus pada akademik, tetapi juga membantu siswa dalam mengembangkan sikap positif, keterampilan berpikir kritis, dan kemandirian.') }}
      </div>
    </div>
  </div>

  @php
    $teachers = $option(
        'teachers-list',
        json_encode([
            [
                'image' => url('/assets/images/template-1/person-1.jpg'),
                'name' => fake()->name(),
            ],
            [
                'image' => url('/assets/images/template-1/person-2.jpg'),
                'name' => fake()->name(),
            ],
            [
                'image' => url('/assets/images/template-1/person-3.jpg'),
                'name' => fake()->name(),
            ],
            [
                'image' => url('/assets/images/template-1/person-4.jpg'),
                'name' => fake()->name(),
            ],
            [
                'image' => url('/assets/images/template-1/person-5.jpg'),
                'name' => fake()->name(),
            ],
            [
                'image' => url('/assets/images/template-1/person-6.jpg'),
                'name' => fake()->name(),
            ],
        ]),
    );
    
    $teachers = json_decode($teachers);
  @endphp

  <div class="container">
    <div class="row">
      @foreach ($teachers as $item)
        <div class="col-xl-4 p-1">
          <div class="card shadow-lg h-full m-4">
            <div class="card-body text-center">
              <img src="{{ $item->image }}" alt="" width="100%">
              <div class="lead text-center">{{ $item->name }}</div>
              <a href="{{ url(request()->slug . '/teacher/' . $loop->index) }}" class="btn btn-primary">Teacher
                Profile</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <div class="container pt-9">
    <div class="text-center">
      <h2>{{ $option('awards-title', 'Prestasi:') }}</h2>
      <div class="lead">
        {{ $option('awards-body', 'SMA 72 Jakarta Selatan memiliki catatan prestasi yang mengesankan dalam bidang akademik, seni, dan olahraga. Siswa kami secara konsisten meraih penghargaan di tingkat lokal, regional, dan nasional. Kami juga mendorong partisipasi siswa dalam kegiatan ekstrakurikuler dan kompetisi, sehingga mereka dapat mengasah bakat dan keterampilan mereka di berbagai bidang.') }}
      </div>
    </div>
  </div>

  @php
    $awards = $option(
        'awards-list',
        json_encode([
            [
                'image' => url('/assets/images/template-1/awards.jpg'),
                'title' => 'Juara 1 Prestasi Akademik Provinsi (PAP)',
            ],
            [
                'image' => url('/assets/images/template-1/awards.jpg'),
                'title' => 'Juara 1 Kejuaraan Olahraga SMA Provinsi (KOSMAPROV)',
            ],
            [
                'image' => url('/assets/images/template-1/awards.jpg'),
                'title' => 'Juara 1 Kompetisi Sains dan Teknologi SMA Provinsi (KOSTAPROV)',
            ],
            [
                'image' => url('/assets/images/template-1/awards.jpg'),
                'title' => 'Juara 1 Piala Debat Bahasa Inggris Provinsi (DEBIPROV)',
            ],
            [
                'image' => url('/assets/images/template-1/awards.jpg'),
                'title' => 'Juara 1 Turnamen Seni Musik dan Tari Provinsi (TUSMITAPROV)',
            ],
            [
                'image' => url('/assets/images/template-1/awards.jpg'),
                'title' => 'Juara 1 Kejuaraan Robotika SMA Provinsi (KEROPROV)',
            ],
        ]),
    );
    
    $awards = json_decode($awards);
  @endphp

  <div class="container">
    <div class="row">
      @foreach ($awards as $item)
        <div class="col-xl-4 p-1">
          <div class="card shadow-lg h-full m-4">
            <div class="card-body">
              <img src="{{ $item->image }}" alt="" width="100%">
              <div class="lead text-center">{{ $item->title }}</div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>


  <div class="container pt-9">
    <div class="text-center">
      <h2>{{ $option('visit-title', 'Kunjungi Kami:') }}</h2>
      <div class="lead">
        {{ $option('visit-body', 'Kami mengundang Anda untuk mengunjungi sekolah kami dan mengenal lebih dekat lingkungan belajar yang kami tawarkan. Silakan hubungi kami untuk membuat janji dan kami akan senang menerima Anda. Terima kasih atas minat Anda dalam Profil SMA 72 Jakarta Selatan. Kami berharap dapat menjadi mitra dalam membantu mencetak generasi muda yang sukses dan berprestasi.') }}
      </div>
    </div>
  </div>
@endsection

@push('head')
  <style>
    .s-hero {
      min-height: 30em;
      background-size: cover;
      background-position: center;
      position: relative;
      background-image: url({{ $option('hero-image', url('/assets/images/template-1/hero.jpg')) }});
    }

    .s-backdrop {
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      background-color: #000;
      opacity: .4;
      position: absolute;
    }

    .h-full {
      height: 100%;
    }
  </style>
@endpush

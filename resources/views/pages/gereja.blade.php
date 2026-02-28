@extends('layout.app')

@section('title', 'Tentang GKKA Samarinda | Profil GKKAI Samarinda')
@section('meta_description', 'Profil GKKA Samarinda (GKKAI Samarinda): sejarah gereja, hamba Tuhan, majelis, komisi, dan pelayanan jemaat.')
@section('meta_image', asset('img/fotogrj.jpeg'))

@section('content')
<section class="bg-blue-900 text-white py-20">
  <div class="gkka-container text-center">
    <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight">Tentang Gereja</h1>
    <p class="text-lg text-blue-200 font-medium">Mengenal lebih dekat GKKA Indonesia Jemaat Samarinda.</p>
  </div>
</section>

<section class="py-20 bg-gray-50">
  <div class="gkka-container">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      
      <a href="{{ route('gereja.sejarah') }}" class="group bg-white p-8 rounded-3xl shadow-lg border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col items-center text-center">
        <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-4xl mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors shadow-sm">
          <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
        </div>
        <h3 class="text-xl font-black text-slate-800 mb-2 group-hover:text-blue-700 transition-colors">Sejarah</h3>
        <p class="text-slate-500 text-sm leading-relaxed">Perjalanan iman dan sejarah berdirinya gereja kami.</p>
      </a>

      <a href="{{ route('gereja.hamba') }}" class="group bg-white p-8 rounded-3xl shadow-lg border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col items-center text-center">
        <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-4xl mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors shadow-sm">
          <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
        </div>
        <h3 class="text-xl font-black text-slate-800 mb-2 group-hover:text-blue-700 transition-colors">Hamba Tuhan</h3>
        <p class="text-slate-500 text-sm leading-relaxed">Profil Hamba Tuhan yang melayani di jemaat kami.</p>
      </a>

      <a href="{{ route('gereja.majelis') }}" class="group bg-white p-8 rounded-3xl shadow-lg border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col items-center text-center">
        <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-4xl mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors shadow-sm">
          <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
        </div>
        <h3 class="text-xl font-black text-slate-800 mb-2 group-hover:text-blue-700 transition-colors">Majelis</h3>
        <p class="text-slate-500 text-sm leading-relaxed">Struktur kepemimpinan dan majelis jemaat.</p>
      </a>

      <a href="{{ route('gereja.komisi') }}" class="group bg-white p-8 rounded-3xl shadow-lg border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col items-center text-center">
        <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-4xl mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors shadow-sm">
          <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
        </div>
        <h3 class="text-xl font-black text-slate-800 mb-2 group-hover:text-blue-700 transition-colors">Komisi</h3>
        <p class="text-slate-500 text-sm leading-relaxed">Wadah pelayanan kategorial untuk setiap jemaat.</p>
      </a>

    </div>
  </div>
</section>
@endsection

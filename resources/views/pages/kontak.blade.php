@extends('layout.app')
@section('title', 'Kontak - GKKA Samarinda')

@section('content')
<section class="py-24 pt-32 bg-gray-50 min-h-screen">
  <div class="w-full max-w-7xl mx-auto px-6">
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col lg:flex-row">
      
      {{-- LEFT COLUMN: Address & Map --}}
      <div class="relative w-full lg:w-5/12 bg-blue-900 text-white p-8 md:p-12 lg:pr-24 overflow-hidden flex flex-col justify-between">
         {{-- Deco Blobs --}}
         <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-blue-800/40 blur-3xl"></div>
         <div class="absolute -left-20 -bottom-20 w-80 h-80 rounded-full bg-blue-600/40 blur-3xl"></div>

         <div class="relative z-10">
            <h3 class="text-2xl font-black mb-8 uppercase tracking-wider border-b border-blue-800 pb-4 inline-block">Informasi Kontak</h3>
            
            <div class="space-y-8">
               <div class="flex items-start gap-4 group">
                  <div class="w-12 h-12 rounded-2xl bg-blue-800/80 flex items-center justify-center shrink-0 text-white group-hover:scale-110 transition-transform shadow-lg border border-blue-700/50">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                  </div>
                  <div>
                     <div class="font-bold text-lg mb-1 text-blue-100">Alamat Gereja</div>
                     <div class="text-white font-medium leading-relaxed opacity-90">
                        Jalan (Alamat Lengkap)<br>Samarinda, Kalimantan Timur
                     </div>
                  </div>
               </div>

               <div class="flex items-start gap-4 group">
                  <div class="w-12 h-12 rounded-2xl bg-blue-800/80 flex items-center justify-center shrink-0 text-white group-hover:scale-110 transition-transform shadow-lg border border-blue-700/50">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                  </div>
                  <div>
                     <div class="font-bold text-lg mb-1 text-blue-100">Telepon</div>
                     <div class="text-white font-medium opacity-90">08xx-xxxx-xxxx</div>
                  </div>
               </div>

               <div class="flex items-start gap-4 group">
                  <div class="w-12 h-12 rounded-2xl bg-blue-800/80 flex items-center justify-center shrink-0 text-white group-hover:scale-110 transition-transform shadow-lg border border-blue-700/50">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                  </div>
                  <div>
                     <div class="font-bold text-lg mb-1 text-blue-100">Email</div>
                     <div class="text-white font-medium opacity-90">info@gkkasamarinda.com</div>
                  </div>
               </div>
            </div>
         </div>

         {{-- Map Embed --}}
         <div class="relative z-10 mt-10 lg:mt-16 rounded-2xl overflow-hidden h-64 border-4 border-white/10 shadow-lg group">
            <iframe 
               src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127637.28424164627!2d117.0601955!3d-0.502187!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df5d57d33074935%3A0xef64e9b06c7ad3e!2sSamarinda%2C%20Samarinda%20City%2C%20East%20Kalimantan!5e0!3m2!1sen!2sid!4v1645000000000!5m2!1sen!2sid" 
               width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
               class="grayscale group-hover:grayscale-0 transition-all duration-500"></iframe>
            <a href="https://maps.google.com" target="_blank" class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors pointer-events-none"></a>
         </div>
      </div>

      {{-- RIGHT COLUMN: Contact Form --}}
      <div class="relative w-full lg:w-7/12 bg-white p-8 md:p-12 lg:p-16">
         {{-- Slanted Divider (Desktop Only) --}}
         <div class="hidden lg:block absolute inset-y-0 -left-20 w-40 bg-white -skew-x-[6deg] transform origin-bottom z-10"></div>
         
         <div class="relative z-20">
            <h2 class="text-3xl font-black text-slate-800 mb-2">Kirim Pesan</h2>
            <p class="text-slate-500 mb-8">Punya pertanyaan atau ingin menyampaikan sesuatu?</p>

            <form action="#" method="POST" class="space-y-6">
               <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div class="space-y-2">
                     <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Nama Lengkap</label>
                     <input type="text" class="w-full px-4 py-3.5 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all font-medium text-slate-800 placeholder-gray-400" placeholder="Nama Anda">
                  </div>
                  <div class="space-y-2">
                     <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Email</label>
                     <input type="email" class="w-full px-4 py-3.5 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all font-medium text-slate-800 placeholder-gray-400" placeholder="email@anda.com">
                  </div>
               </div>

               <div class="space-y-2">
                  <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Subjek</label>
                  <div class="relative">
                    <select class="w-full px-4 py-3.5 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all font-medium text-slate-800 appearance-none cursor-pointer">
                       <option>Pertanyaan Umum</option>
                       <option>Permohonan Doa</option>
                       <option>Konseling / Pastoral</option>
                       <option>Lainnya</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                    </div>
                  </div>
               </div>

               <div class="space-y-2">
                  <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Pesan</label>
                  <textarea rows="5" class="w-full px-4 py-3.5 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all font-medium text-slate-800 placeholder-gray-400 resize-none" placeholder="Tulis pesan Anda di sini..."></textarea>
               </div>

               <button type="submit" class="w-full py-4 rounded-xl bg-blue-600 text-white font-black text-lg shadow-xl shadow-blue-600/30 hover:bg-blue-700 hover:shadow-2xl hover:shadow-blue-600/40 hover:-translate-y-1 transition-all duration-300">
                  Kirim Pesan
               </button>
            </form>
         </div>
      </div>

    </div>
  </div>
</section>
@endsection

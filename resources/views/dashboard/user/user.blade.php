<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            Dashboard User Test
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-indigo-600 to-blue-600 overflow-hidden shadow-lg rounded-lg mb-6">
                <div class="p-6 text-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-lg">Selamat datang, <span class="font-bold">{{ auth()->user()->name }}</span>!</p>
                            <p class="text-sm opacity-90 mt-1">Apa yang ingin Anda laporkan hari ini?</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="mb-6">
                <a href="{{ route('user.reports.create') }}"
                   class="inline-flex items-center bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-200 transform hover:scale-[1.02]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Buat Laporan Baru
                </a>
            </div>
            <form method="GET" action="{{ route('dashboard.user') }}" class="mb-8 bg-white p-4 rounded-lg shadow-md">
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cari Deskripsi</label>
                        <input type="text" name="search" placeholder="Cari laporan..." value="{{ request('search') }}"
                            class="w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                    </div>
               
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Laporan</label>
                        <select name="type" class="w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Semua Jenis</option>
                            <option value="KEJAHATAN" {{ request('type') == 'KEJAHATAN' ? 'selected' : '' }}>Kejahatan</option>
                            <option value="PEMBANGUNAN" {{ request('type') == 'PEMBANGUNAN' ? 'selected' : '' }}>Pembangunan</option>
                            <option value="SOSIAL" {{ request('type') == 'SOSIAL' ? 'selected' : '' }}>Sosial</option>
                        </select>
                    </div>


                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Urutkan</label>
                        <select name="sort" class="w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Terbaru</option>
                            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Terlama</option>
                        </select>
                    </div>
               
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition duration-200">
                            <div class="flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Filter
                            </div>
                        </button>
                    </div>
                </div>
            </form>
            <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                Laporan Terkini
            </h3>
            @if($reports->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($reports as $report)
                        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition duration-200">
                            @if ($report->image)
                                <div class="h-48 overflow-hidden">
                                    <img src="{{ asset('storage/' . $report->image) }}" alt="Gambar Laporan" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <div class="p-5">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                        {{ $report->type }}
                                    </span>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                                            {{ $report->status === 'PROSES' ? 'bg-yellow-100 text-yellow-800' :
                                            ($report->status === 'DITOLAK' ? 'bg-red-100 text-red-800' :
                                            ($report->status === 'SELESAI' ? 'bg-green-100 text-green-800' :
                                            'bg-gray-100 text-gray-800')) }}">
                                            {{ ucfirst(strtolower($report->status)) }}
                                    </span>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ Str::limit($report->title, 50) }}</h4>
                                <p class="text-gray-700 text-sm mb-4">{{ Str::limit($report->description, 100) }}</p>
                                <div class="border-t border-gray-100 pt-3">
                                    <div class="flex items-center text-sm text-gray-600 mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $report->village }}, {{ $report->subdistrict }}
                                    </div>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $report->created_at->translatedFormat('d M Y, H:i') }}
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <span class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                {{ $report->views ?? 0 }}
                                            </span>
                                            <span class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                </svg>
                                                {{ $report->likes_count ?? 0 }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 pt-3 border-t border-gray-100 flex justify-between">
                                    <a href="{{ route('user.reports.show', $report->id) }}"
                                       class="text-indigo-600 hover:text-indigo-800 font-medium text-sm flex items-center">
                                        Lihat Detail
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                    @if (auth()->id() === $report->user_id)
                                        <div class="flex space-x-3">
                                            <a href="{{ route('user.reports.edit', $report->id) }}"
                                               class="text-yellow-600 hover:text-yellow-800 text-sm flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('user.reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $reports->links() }}
                </div>
            @else
                <div class="bg-white p-8 text-center rounded-xl shadow-md border border-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h4 class="text-lg font-medium text-gray-900 mb-2">Belum ada laporan yang tersedia</h4>
                    <p class="text-gray-600 mb-4">Anda bisa menjadi yang pertama membuat laporan</p>
                    <a href="{{ route('user.reports.create') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                        Buat laporan sekarang
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

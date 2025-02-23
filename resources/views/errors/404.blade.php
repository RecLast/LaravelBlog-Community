<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <h1 class="text-6xl font-bold text-gray-800 mb-4">404</h1>
                    <h2 class="text-2xl font-semibold text-gray-600 mb-4">Sayfa Bulunamadı</h2>
                    <p class="text-gray-500 mb-8">Aradığınız sayfa mevcut değil veya taşınmış olabilir.</p>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Ana Sayfaya Dön
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!DOCTYPE html>
<html>
<head>
    <title>{{ $title ?? 'Travel Itinerary Planner' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(86, 77, 54, 0.8);
            pointer-events: none;
        }
        #mapContainer {
            height: calc(100% - 40px);
            width: 100%;
        }
        .hidden {
            display: none;
        }
    </style>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch/dist/geosearch.css" />
</head>
<body class="relative flex flex-col items-center min-h-screen m-0 p-0 bg-cover"
      style="font-family: 'Roboto', sans-serif; background-image: url('{{ asset('/images/texture.jpg') }}'); background-size: cover;">
<div class="overlay"></div>
<nav class="relative w-full py-4 px-6 flex justify-between items-center z-10">
    <div>
        <a href="/" class="text-black text-3xl font-bold flex">
            <img width="35" height="35" src="https://img.icons8.com/ios-filled/35/airport.png" alt="airplane"
                 class="mr-5"/>
            Travel Itinerary Planner
        </a>
    </div>
    <div>
        <a href="/" class="text-[#DAC7A0] hover:text-[#FFCC00] px-4">Home</a>
        <a href="{{ route('destinations.index') }}" class="text-[#DAC7A0] hover:text-[#FFCC00] px-4">Destinations</a>
        @guest
            <a href="{{ route('login') }}" class="text-[#DAC7A0] hover:text-[#FFCC00] px-4">Login</a>
            <a href="{{ route('register') }}" class="text-[#DAC7A0] hover:text-[#FFCC00] px-4">Register</a>
        @else
            <a href="{{ route('dashboard') }}" class="text-[#DAC7A0] hover:text-[#FFCC00] px-4">Dashboard</a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-[#DAC7A0] hover:text-[#FFCC00] px-4">Logout</button>
            </form>
        @endguest
        <a href="nonexistent" class="text-[#DAC7A0] hover:text-[#FFCC00] px-4">404 error</a>
    </div>
</nav>
<div class="relative z-10 w-full flex flex-col items-center">
    {{ $slot }}

    <!-- Modal -->
    <div id="deleteModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-[#564D36] opacity-90"></div>
            </div>
            <div class="bg-white rounded-xl overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <h2 class="text-3xl font-semibold mb-4 text-[#A0522D]">Confirm Deletion</h2>
                <p class="text-lg text-gray-800">Are you sure you want to delete this destination?</p>
                <div class="mt-6 flex justify-end">
                    <button onclick="closeModal()"
                            class="px-4 py-2 bg-[#DAC7A0] text-gray-800 rounded hover:bg-[#E6B800] mr-2">Cancel
                    </button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-[#A0522D] text-white rounded hover:bg-[#E6B800]">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div id="successMessage" class="fixed top-15 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function () {
                document.getElementById('successMessage').remove();
            }, 3000);
        </script>
    @endif

    <script>
        function openModal(action) {
            document.getElementById('deleteForm').action = action;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</div>
</body>
</html>

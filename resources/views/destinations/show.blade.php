<x-layouts.app>
    <div class="breadcrumb w-11/12 max-w-5xl mt-10">
        <a href="/" class="text-white hover:underline">Home</a>
        <span class="text-white mx-2">/</span>
        <a href="{{ route('destinations.index') }}" class="text-white hover:underline">Your Destinations</a>
        <span class="text-white mx-2">/</span>
        <span class="text-white">Destination Details</span>
    </div>
    <div class="ticket-container flex flex-col items-center w-11/12 max-w-5xl mt-5 bg-transparent shadow-lg">
        <div class="ticket flex flex-col md:flex-row w-full">
            <div class="ticket-left w-full md:w-1/3 text-center flex flex-col justify-center items-center p-5 bg-ticket-left rounded-xl mb-2 md:mb-0 shadow-lg">
                <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/airport.png" alt="airplane"/>
                <div class="app-name text-2xl font-bold text-gray-800 mt-3">TRAVEL ITINERARY PLANNER</div>
                <div class="description mt-5 text-lg text-gray-800">Plan your trips by adding destinations, activities, and notes for each day of the trip.</div>
            </div>
            <div class="ticket-right w-full md:w-2/3 bg-ticket-right p-5 rounded-xl flex flex-col justify-center shadow-lg">
                <div class="content relative">
                    <div class="ticket-header text-3xl font-bold text-gray-800 mb-3">Destination Details</div>
                    <div class="destination-info mb-5">
                        <p><strong>Name:</strong> {{ $destination->name }}</p>
                        <p><strong>Visit Date:</strong> {{ $destination->visit_date }}</p>
                        <p><strong>Reason:</strong> {{ $destination->reason }}</p>
                        <p><strong>City:</strong> {{ $destination->location }}</p>
                        <p><strong>Full Address:</strong> <span id="full-address">Loading...</span></p>
                    </div>
                    <a href="{{ route('destinations.edit', $destination->id) }}" class="ticket-button px-4 py-2 text-white bg-[#E6B800] rounded-md hover:bg-[#FFCC00]">Edit</a>
                    <button onclick="openModal('{{ route('destinations.destroy', $destination->id) }}')" class="ticket-button px-4 py-2 text-white bg-[#8B4513] rounded-md hover:bg-[#A0522D]">Delete</button>
                    <a href="{{ route('destinations.index') }}" class="ticket-button px-4 py-2 text-white bg-[#40392B] rounded-md hover:bg-[#564D36] mt-3">Back to List</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const lat = {{ $destination->latitude }};
            const lng = {{ $destination->longitude }};
            const provider = new window.OpenStreetMapProvider();

            provider.search({ query: `${lat},${lng}` }).then(function(result) {
                if (result && result.length > 0) {
                    document.getElementById('full-address').textContent = result[0].label;
                } else {
                    document.getElementById('full-address').textContent = 'Address not found';
                }
            }).catch(function(error) {
                document.getElementById('full-address').textContent = 'Error fetching address';
            });
        });
    </script>
</x-layouts.app>

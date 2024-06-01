<x-layouts.app>
    <div class="breadcrumb w-11/12 max-w-5xl mt-10">
        <a href="/" class="text-white hover:underline">Home</a>
        <span class="text-white mx-2">/</span>
        <span class="text-white">Your Destinations</span>
    </div>
    <div class="ticket-container flex flex-col items-center w-11/12 max-w-5xl mt-5 mb-32 bg-transparent shadow-lg">
        <div class="ticket flex flex-col md:flex-row w-full">
            <div class="ticket-left w-full md:w-1/3 text-center flex flex-col justify-center items-center p-5 bg-ticket-left rounded-xl mb-2 md:mb-0 shadow-lg">
                <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/airport.png" alt="airplane"/>
                <div class="app-name text-2xl font-bold text-gray-800 mt-3">TRAVEL ITINERARY PLANNER</div>
                <div class="description mt-5 text-lg text-gray-800">Plan your trips by adding destinations, activities, and notes for each day of the trip.</div>
            </div>
            <div class="ticket-right w-full md:w-2/3 bg-ticket-right p-5 rounded-xl flex flex-col justify-center shadow-lg">
                <div class="content relative">
                    <div class="ticket-header text-5xl font-bold text-gray-800 mb-3">YOUR DESTINATIONS</div>
                    <a href="{{ route('destinations.create') }}" class="ticket-button inline-block mt-5 px-6 py-3 text-lg text-white bg-[#40392B] rounded-md hover:bg-[#E6B800]">Add a Destination</a>
                    <ul class="destinations-list mt-5">
                        @foreach ($destinations as $destination)
                            <li class="my-3">
                                <div class="destination-details bg-gray-50 p-3 rounded-md shadow-md">
                                    <div class="destination-info mb-3">
                                        <p><strong>Name:</strong> {{ $destination->name }}</p>
                                        <p><strong>Visit Date:</strong> {{ $destination->visit_date }}</p>
                                        <p><strong>Reason:</strong> {{ $destination->reason }}</p>
                                    </div>
                                    <div class="destination-actions flex space-x-3">
                                        <a href="{{ route('destinations.show', $destination->id) }}" class="ticket-button px-4 py-2 text-white bg-[#40392B] rounded-md hover:bg-[#564D36]">View</a>
                                        <a href="{{ route('destinations.edit', $destination->id) }}" class="ticket-button px-4 py-2 text-white bg-[#E6B800] rounded-md hover:bg-[#FFCC00]">Edit</a>
                                        <button onclick="openModal('{{ route('destinations.destroy', $destination->id) }}')" class="ticket-button px-4 py-2 text-white bg-[#8B4513] rounded-md hover:bg-[#A0522D]">Delete</button>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

<x-layouts.app>
    <div class="breadcrumb w-11/12 max-w-5xl mt-10">
        <a href="/" class="text-white hover:underline">Dashboard</a>
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
                    <div class="ticket-header text-5xl font-bold text-gray-800 mb-3">BOARDING PASS AIRLINE TICKET</div>
                    <a href="{{ route('destinations.create') }}" class="ticket-button inline-block mt-5 px-6 py-3 text-lg text-white bg-[#40392B] rounded-md hover:bg-[#E6B800]">Add a Destination</a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

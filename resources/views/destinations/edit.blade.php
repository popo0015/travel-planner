<x-layouts.app>
    <div class="breadcrumb w-11/12 max-w-5xl mt-10">
        <a href="/" class="text-white hover:underline">Home</a>
        <span class="text-white mx-2">/</span>
        <a href="{{ route('destinations.index') }}" class="text-white hover:underline">Your Destinations</a>
        <span class="text-white mx-2">/</span>
        <span class="text-white">Edit Destination</span>
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
                    <div class="ticket-header text-3xl font-bold text-gray-800 mb-3">Edit Destination</div>

                    <div id="error-messages" class="mb-5"></div> <!-- Error messages container -->

                    <form action="{{ route('destinations.update', $destination->id) }}" method="POST" onsubmit="return validateForm()">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-5">
                            <label for="name" class="block text-lg font-semibold">Name:</label>
                            <input type="text" id="name" name="name" value="{{ $destination->name }}" required class="w-full px-3 py-2 mt-2 border rounded-lg" maxlength="100">
                            @error('name')
                            <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-5">
                            <label for="visit_date" class="block text-lg font-semibold">Visit Date:</label>
                            <input type="date" id="visit_date" name="visit_date" value="{{ $destination->visit_date }}" required class="w-full px-3 py-2 mt-2 border rounded-lg" min="{{ date('Y-m-d') }}">
                            @error('visit_date')
                            <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-5">
                            <label for="reason" class="block text-lg font-semibold">Reason:</label>
                            <select id="reason" name="reason" required class="w-full px-3 py-2 mt-2 border rounded-lg">
                                <option value="" disabled>Select a reason</option>
                                <option value="work" {{ $destination->reason == 'work' ? 'selected' : '' }}>Work Visit</option>
                                <option value="holiday" {{ $destination->reason == 'holiday' ? 'selected' : '' }}>Holiday</option>
                                <option value="study" {{ $destination->reason == 'study' ? 'selected' : '' }}>Study</option>
                                <option value="relatives" {{ $destination->reason == 'relatives' ? 'selected' : '' }}>Visit relatives</option>
                                <option value="event" {{ $destination->reason == 'event' ? 'selected' : '' }}>Event <i>(eg. concert, sports game, etc.)</i></option>
                                <option value="other" {{ $destination->reason == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('reason')
                            <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="ticket-button px-6 py-3 text-white bg-[#FFCC00] rounded-md hover:bg-[#E6B800]">Update</button>
                        <a href="{{ route('destinations.index') }}" class="ticket-button px-6 py-3 text-white bg-[#40392B] rounded-md hover:bg-[#564D36] mt-5">Back to List</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            const name = document.getElementById('name').value;
            const visitDate = document.getElementById('visit_date').value;
            const reason = document.getElementById('reason').value;

            let errors = [];

            if (!name) {
                errors.push({ field: 'name', message: 'The name field is required.' });
            }

            if (name.length > 25) {
                errors.push({ field: 'name', message: 'The name field must be less than 25 characters.' });
            }

            if (!visitDate) {
                errors.push({ field: 'visit_date', message: 'The visit date field is required.' });
            }

            if (!reason) {
                errors.push({ field: 'reason', message: 'The reason field is required.' });
            }

            if (errors.length > 0) {
                displayErrors(errors);
                return false;
            }

            return true;
        }

        function displayErrors(errors) {
            document.querySelectorAll('.text-red-500').forEach(function (el) {
                el.remove();
            });

            errors.forEach(function (error) {
                showFieldError(error.field, error.message);
            });
        }

        function showFieldError(fieldId, message) {
            const field = document.getElementById(fieldId);
            const errorContainer = document.createElement('div');
            errorContainer.classList.add('text-red-500', 'mt-1', 'text-sm');
            errorContainer.innerText = message;

            const existingError = field.parentNode.querySelector('.text-red-500');
            if (existingError) {
                existingError.remove();
            }

            field.parentNode.appendChild(errorContainer);
        }
        </script>
</x-layouts.app>

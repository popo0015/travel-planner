<x-layouts.app>
    <div class="breadcrumb w-11/12 max-w-5xl mt-10">
        <a href="/" class="text-white hover:underline">Home</a>
        <span class="text-white mx-2">/</span>
        <a href="{{ route('destinations.index') }}" class="text-white hover:underline">Your Destinations</a>
        <span class="text-white mx-2">/</span>
        <span class="text-white">Add a Destination</span>
    </div>
    <div class="ticket-container flex flex-col items-center w-11/12 max-w-5xl mt-5 bg-transparent shadow-lg">
        <div class="ticket flex flex-col md:flex-row w-full">
            <div
                class="ticket-left w-full md:w-1/3 text-center flex flex-col justify-center items-center p-5 bg-ticket-left rounded-xl mb-2 md:mb-0 shadow-lg bg-[#DAC7A0]">
                <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/airport.png" alt="airplane"/>
                <div class="app-name text-2xl font-bold text-gray-800 mt-3">TRAVEL ITINERARY PLANNER</div>
                <div class="description mt-5 text-lg text-gray-800">Plan your trips by adding destinations, activities,
                    and notes for each day of the trip.
                </div>
            </div>
            <div
                class="ticket-right w-full md:w-2/3 bg-ticket-right p-5 rounded-xl flex flex-col justify-center shadow-lg bg-[#F3E4B3]">
                <div class="content relative">
                    <div class="ticket-header text-3xl font-bold text-gray-800 mb-3">Add a Destination</div>

                    <div id="error-messages" class="mb-5"></div> <!-- Error messages container -->

                    @if ($errors->any())
                        <div class="message error mb-5 text-red-500">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('destinations.store') }}" method="POST" onsubmit="return validateForm()">
                        @csrf
                        <div class="form-group mb-5">
                            <label for="name" class="block text-lg font-semibold">Name:</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                   class="w-full px-3 py-2 mt-2 border rounded-lg" maxlength="100">
                            @if ($errors->has('name'))
                                <div class="text-red-500 mt-1 text-sm">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="form-group mb-5">
                            <label for="visit_date" class="block text-lg font-semibold">Visit Date:</label>
                            <input type="date" id="visit_date" name="visit_date" value="{{ old('visit_date') }}"
                                   required class="w-full px-3 py-2 mt-2 border rounded-lg" min="{{ date('Y-m-d') }}">
                            @if ($errors->has('visit_date'))
                                <div class="text-red-500 mt-1 text-sm">{{ $errors->first('visit_date') }}</div>
                            @endif
                        </div>
                        <div class="form-group mb-5">
                            <label for="reason" class="block text-lg font-semibold">Reason:</label>
                            <select id="reason" name="reason" required class="w-full px-3 py-2 mt-2 border rounded-lg">
                                <option value="" disabled selected>Select a reason</option>
                                <option value="work" {{ old('reason') == 'work' ? 'selected' : '' }}>Work Visit</option>
                                <option value="holiday" {{ old('reason') == 'holiday' ? 'selected' : '' }}>Holiday
                                </option>
                                <option value="study" {{ old('reason') == 'study' ? 'selected' : '' }}>Study</option>
                                <option value="relatives" {{ old('reason') == 'relatives' ? 'selected' : '' }}>Visit
                                    relatives
                                </option>
                                <option value="event" {{ old('reason') == 'event' ? 'selected' : '' }}>Event <i>(eg.
                                        concert, sports game, etc.)</i></option>
                                <option value="other" {{ old('reason') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @if ($errors->has('reason'))
                                <div class="text-red-500 mt-1 text-sm">{{ $errors->first('reason') }}</div>
                            @endif
                        </div>
                        <div class="form-group mb-5">
                            <label for="location" class="block text-lg font-semibold">Location:</label>
                            <input type="text" id="location" name="location" value="{{ old('location') }}" required
                                   class="w-full px-3 py-2 mt-2 border rounded-lg" readonly onclick="openMapModal()">
                            @if ($errors->has('location'))
                                <div class="text-red-500 mt-1 text-sm">{{ $errors->first('location') }}</div>
                            @endif
                        </div>

                        <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}">
                        <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}">

                        <button type="submit"
                                class="ticket-button px-6 py-3 text-white bg-[#FFCC00] rounded-md hover:bg-[#E6B800]">
                            Add Destination
                        </button>
                        <a href="{{ route('destinations.index') }}"
                           class="ticket-button px-6 py-3 text-white bg-[#40392B] rounded-md hover:bg-[#564D36] mt-5">Back
                            to List</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="mapModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg p-6 w-3/4 h-3/4">
            <div class="flex justify-end mb-4">
                <button onclick="closeMapModal()" class="text-red-500">Close</button>
            </div>
            <div id="mapContainer" class="w-full h-full"></div>
        </div>
    </div>

    <script>
        function validateForm() {
            const name = document.getElementById('name').value;
            const location = document.getElementById('location').value;
            const visitDate = document.getElementById('visit_date').value;
            const reason = document.getElementById('reason').value;
            const latitude = document.getElementById('latitude').value;
            const longitude = document.getElementById('longitude').value;

            let errors = [];

            if (!name) {
                errors.push({field: 'name', message: 'The name field is required.'});
            }
            if (name.length > 25) {
                errors.push({field: 'name', message: 'The name field must be less than 25 characters.'});
            }
            if (!location) {
                errors.push({field: 'location', message: 'The location field is required.'});
            }
            if (!visitDate) {
                errors.push({field: 'visit_date', message: 'The visit date field is required.'});
            }
            if (!reason) {
                errors.push({field: 'reason', message: 'The reason field is required.'});
            }
            if (!latitude || !longitude) {
                errors.push({field: 'location', message: 'The location must be selected on the map.'});
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

        function openMapModal() {
            document.getElementById('mapModal').classList.remove('hidden');
            initializeMap();
        }

        function closeMapModal() {
            document.getElementById('mapModal').classList.add('hidden');
        }

        function initializeMap() {
            const map = L.map('mapContainer').setView([51.505, -0.09], 2);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
            }).addTo(map);

            const provider = new window.GeoSearch.OpenStreetMapProvider();

            const searchControl = new window.GeoSearch.GeoSearchControl({
                provider: provider,
                style: 'bar',
                autoComplete: true,
                autoCompleteDelay: 250,
                showMarker: true,
                retainZoomLevel: false,
                animateZoom: true,
                keepResult: true,
            });

            map.addControl(searchControl);

            let marker;

            function setMarker(lat, lng, label) {
                if (marker) {
                    marker.setLatLng([lat, lng]);
                } else {
                    marker = L.marker([lat, lng]).addTo(map);
                }
                map.setView([lat, lng], 12);
                document.getElementById('location').value = extractCity(label);
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            }

            function extractCity(address) {
                const parts = address.split(',');
                let city = '';
                if (parts.length > 1) {
                    city = parts[parts.length - 2].trim();
                } else {
                    city = address;
                }
                if (city.match(/\d/)) {
                    city = parts.length > 3 ? parts[parts.length - 3].trim() : city;
                }
                return city;
            }

            map.on('geosearch/showlocation', function (result) {
                const {x, y, label} = result.location;
                setMarker(y, x, label);
                closeMapModal();
            });

            map.on('click', async function (event) {
                const {lat, lng} = event.latlng;
                const response = await provider.search({query: `${lat},${lng}`});
                if (response && response.length > 0) {
                    const result = response[0];
                    setMarker(lat, lng, result.label);
                }
                closeMapModal();
            });
        }
    </script>
</x-layouts.app>

<div id="mapContainer"></div>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
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

            map.on('geosearch/showlocation', function(result) {
                const { x, y, label } = result.location;
                document.getElementById('location').value = label;
                document.getElementById('latitude').value = y;
                document.getElementById('longitude').value = x;
                closeMapModal();
            });
        });
    </script>
@endpush

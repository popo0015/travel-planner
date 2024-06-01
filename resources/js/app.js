import './bootstrap';

import 'leaflet/dist/leaflet.css';
import 'leaflet-geosearch/dist/geosearch.css';

import L from 'leaflet';
import { GeoSearchControl, OpenStreetMapProvider } from 'leaflet-geosearch';

window.L = L;
window.GeoSearchControl = GeoSearchControl;
window.OpenStreetMapProvider = OpenStreetMapProvider;

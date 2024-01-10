import './assets/main.css';

import { createApp } from 'vue';
import UrlShortener from './components/url-shortener/UrlShortener.vue';

createApp({}).component('UrlShortener', UrlShortener).mount('#app');

import {createApp} from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import store from './store'
import './assets/tailwind/index.css'
import axios from "axios";
import $ from 'jquery';
import i18n from './i18n';


axios.defaults.baseURL = 'https://ezy.company/api/';
// axios.defaults.baseURL = 'http://127.0.0.1:8000/api/';


createApp(App).use(i18n).use($).use(store).use(router).mount('#app')

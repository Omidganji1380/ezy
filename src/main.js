import { createApp } from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import store from './store'
import cors from 'cors'
import './assets/tailwind/index.css'

// cors({
//     origin:'http://127.0.0.1:8000',
//     credentials:true,            //access-control-allow-credentials:true
//     optionSuccessStatus:200
// })

createApp(App).use(store).use(router).mount('#app')

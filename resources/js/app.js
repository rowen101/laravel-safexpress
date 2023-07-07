import './bootstrap';
import { createApp } from 'vue';

import App from './app/pages/App.vue'
import router from "./app/router";

createApp(App)
    .use(router)
    .mount("#app")



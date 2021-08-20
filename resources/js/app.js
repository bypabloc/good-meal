import { createApp } from 'vue'
import Home from './views/Home';

require('./bootstrap');

const app = createApp({});
    app.component('home', Home)
        .mount('#app');
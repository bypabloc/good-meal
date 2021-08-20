import { createApp } from 'vue'
import Home from './views/Home';

const app = createApp({});
    app.component('home', Home)
        .mount('#app');

require('./bootstrap');

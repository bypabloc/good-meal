import { createApp } from 'vue'
import Home from './views/Home';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

require('./bootstrap');

const app = createApp({});
    app.use(VueSweetalert2);
    app.component('home', Home)
        .mount('#app');
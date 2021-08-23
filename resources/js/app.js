import { createApp } from 'vue'
import Home from './views/Home';
import Admin from './views/Admin';

import { library } from '@fortawesome/fontawesome-svg-core'
import { faInfo } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faInfo)

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

require('./bootstrap');

const app = createApp({});


app.mixin({  
    methods: {
        ObjectErrorsToString(list) {
            let string = '';
        
            for (const e in list) {
                string += `${e}:<br/>`
        
                for (const f of list[e]) {
                    string += `- ${f}<br/>`
                }
            }
        
            return string;
        },
        calculateAge(age) {
            const birth = new Date(age); // '08/08/1991' - '07/11/2003'
            const check = new Date();

            const milliDay = 1000 * 60 * 60 * 24; // a day in milliseconds;

            const ageInDays = (check - birth) / milliDay;

            return Math.floor(ageInDays / 365 );
        },
    },
})
app.use(VueSweetalert2);

app.component('font-awesome-icon', FontAwesomeIcon)
app.component('home', Home)
app.component('admin', Admin)
    .mount('#app');
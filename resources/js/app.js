require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp, Head } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { Transition, TransitionGroup } from 'vue'//chanchada para arreglar los errores de vue3-treeslect
// Element ui
//import ElementPlus from 'element-plus'
//import 'element-plus/dist/index.css'
import PrimeVue from 'primevue/config';

//Prime Vue
import 'primevue/resources/primevue.min.css'
import 'primevue/resources/themes/bootstrap4-light-blue/theme.css'
import 'primeicons/primeicons.css'
//

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
//console.log(quill)
import ToastService from 'primevue/toastservice';
//
import AppLayout from "@/Layouts/AppLayout.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const app = createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const page = require(`./Pages/${name}.vue`).default
        if (name.startsWith('Admin/')) {
            page.layout = AdminLayout
        } else {
            page.layout = AppLayout
        }
        return page
    },
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(PrimeVue)
            .use(ToastService)
            //.use(ElementPlus)
            .mixin({ methods: { route }, components: { Transition, TransitionGroup, Head } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#6875f5' });


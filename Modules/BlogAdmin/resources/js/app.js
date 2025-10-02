import { createApp, h } from 'vue'
import { createInertiaApp, Link, useForm } from '@inertiajs/vue3'
import { Head } from '@inertiajs/vue3'
import '../css/app.css'
import { ZiggyVue } from '../../../../vendor/tightenco/ziggy';


createInertiaApp({
    title: title => `${title} ${import.meta.env.VITE_APP_NAME}`,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]
        return page;
    },
    setup({ el, App, props }) {
        createApp({ render: () => h(App, props) })
            .mount(el)
    }
})

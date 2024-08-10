require('./bootstrap');

import { createApp } from 'vue'
// Vue.component('admin', require('./components/admin/AdminComponent.vue').default);

import Admin from './components/admin/main/AdminComponent.vue'
import Header from './components/admin/main/HeaderComponent.vue'
import Footer from './components/admin/main/FooterComponent.vue'

const app = createApp();

app.component('AdminHeader', Header)
app.component('AdminBody', Admin)
app.component('AdminFooter', Footer)


app.mount('#admin-app')

require('./bootstrap');

import { createApp } from 'vue'

import AdminIndex from './components/admin/pages/index.vue'
import AdminHeader from './components/admin/ui/AppHeader.vue'
import AdminAside from './components/admin/ui/AppAside.vue'
import AdminModerationPage from './components/admin/pages/BloggersModeration.vue'

const app = createApp();

app.component('admin-index', AdminIndex)
app.component('admin-header', AdminHeader)
app.component('admin-aside', AdminAside)
app.component('admin-bloggers-moderation-page', AdminModerationPage)


app.mount('#admin-app')

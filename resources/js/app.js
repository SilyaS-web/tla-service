require('./bootstrap');

import { createApp } from 'vue'

import Header from './components/admin/ui/AppHeader.vue'
import Aside from './components/admin/ui/AppAside.vue'
import ModerationPage from './components/admin/pages/BloggersModeration.vue'

const app = createApp();

app.component('admin-header', Header)
app.component('admin-aside', Aside)
app.component('admin-bloggers-moderation-page', ModerationPage)


app.mount('#admin-app')

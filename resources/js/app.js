require('./bootstrap');

import { createApp } from 'vue'

import AdminIndex from './components/admin/pages/index.vue'
import AdminHeader from './components/admin/ui/AppHeader.vue'
import AdminAside from './components/admin/ui/AppAside.vue'
import AdminModerationPage from './components/admin/pages/BloggersModeration.vue'
import AdminBloggersPage from './components/admin/pages/AppBloggers.vue'
import AdminSellersPage from './components/admin/pages/AppSellers.vue'
import AdminProjectsPage from './components/admin/pages/AppProjects.vue'
import AdminOrdersPage from './components/admin/pages/AppOrders.vue'

const adminApp = createApp();

adminApp.component('admin-index', AdminIndex)
adminApp.component('admin-header', AdminHeader)
adminApp.component('admin-aside', AdminAside)
adminApp.component('admin-bloggers-moderation-page', AdminModerationPage)
adminApp.component('admin-bloggers-page', AdminBloggersPage)
adminApp.component('admin-sellers-page', AdminSellersPage)
adminApp.component('admin-projects-page', AdminProjectsPage)
adminApp.component('admin-orders-page', AdminOrdersPage)


adminApp.mount('#admin-app')


import Auth from './components/auth/pages/AppAuth.vue'
import Register from './components/auth/pages/AppRegister.vue'

const app = createApp();

app.component('auth-page', Auth)
app.component('register-page', Register)


app.mount('#app')

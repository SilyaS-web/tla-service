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
import AdminReferalDataPage from './components/admin/pages/ReferalData.vue'

const app = createApp();

app.component('admin-index', AdminIndex)
app.component('admin-header', AdminHeader)
app.component('admin-aside', AdminAside)
app.component('admin-bloggers-moderation-page', AdminModerationPage)
app.component('admin-bloggers-page', AdminBloggersPage)
app.component('admin-sellers-page', AdminSellersPage)
app.component('admin-projects-page', AdminProjectsPage)
app.component('admin-orders-page', AdminOrdersPage)
app.component('admin-referal-data-page', AdminReferalDataPage)


app.mount('#admin-app')

require('./bootstrap');

import { createApp } from 'vue'
import { createMemoryHistory, createRouter } from 'vue-router'

// admin imports
import AdminIndex from './src/admin/pages/index.vue'

const app = createApp();

app.component('admin-index', AdminIndex)
app.mount('#app')

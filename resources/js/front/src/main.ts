import { createApp, h } from 'vue'
import { router } from './router';
import './style.css'
import App from './App.vue';
import 'vue3-toastify/dist/index.css';
import { MdEditor } from 'md-editor-v3';
import 'md-editor-v3/lib/style.css';

const app = createApp({
  render: () => h(App),
})

app.use(router)

app.component('MarkdownEditor', MdEditor);
app.component('MarkdownPreview', MdEditor);

app.mount('#app');

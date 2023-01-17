import './bootstrap'
import '../css/app.css'

import App from './components/App.svelte'

const AppComponent = new App({
  target: document.querySelector('#root')
})

export default AppComponent
import './bootstrap'
import '../css/app.css'

import ReactDOM from 'react-dom/client'
import { RouterProvider } from "react-router-dom" 
import Themes from './Themes'
import React from 'react'
import router from './router'
import {ContextProvider} from './contexts/ContextProvider.jsx'

ReactDOM.createRoot(document.getElementById('app')).render(  
    <React.StrictMode>
        <ContextProvider>
            <RouterProvider router={router} />
        </ContextProvider>
    </React.StrictMode>
)

/*
<BrowserRouter>
    <Themes />
</BrowserRouter> 
*/
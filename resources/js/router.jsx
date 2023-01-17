import { createBrowserRouter, Navigate } from "react-router-dom"
import Login from './views/Login'
import Register from './views/Register'

import Users from './views/Users'
import UserForm from './views/UserForm'
import Dashboard from './views/Dashboard'
import PageNotFound from './PageNotFound'

import DefaultLayout from './components/DefaultLayout'
import GuestLayout from './components/GuestLayout'

const router = createBrowserRouter([
    {
        path: '/react',
        element: <DefaultLayout />,
        children: [
            {
                path: '/react',
                element: <Navigate to="/react/users" />
            },
            {
                path: '/react/users',
                element: <Users />
            },
            {
                path: '/react/users/new',
                element: <UserForm key="userCreate" />
            },
            {
                path: '/react/users/:id',
                element: <UserForm key="userUpdate" />
            },
            {
                path: '/react/dashboard',
                element: <Dashboard />
            }
        ]
    },
    {
        path: '/react',
        element: <GuestLayout />,
        children: [
            {
                path: '/react/login',
                element: <Login />
            },
            {
                path: '/react/register',
                element: <Register />
            }
        ]
    },
    {
        path: '*',
        element: <PageNotFound />
    }
])

export default router
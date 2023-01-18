import { createBrowserRouter, Navigate } from "react-router-dom"
import Login from './Views/Login'
import Register from './Views/Register'

import Users from './Views/Users'
import UserForm from './Views/UserForm'
import Dashboard from './Views/Dashboard'
import PageNotFound from './PageNotFound'

import DefaultLayout from './Components/DefaultLayout'
import GuestLayout from './Components/GuestLayout'

const router = createBrowserRouter([
    {
        path: '/react',
        element: <DefaultLayout />,
        children: [
            {
                path: '/react',
                element: <NaVigate to="/react/users" />
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
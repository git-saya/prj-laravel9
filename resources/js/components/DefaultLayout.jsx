import { useEffect } from "react"
import { Link, Navigate, Outlet } from "react-router-dom"
import axiosClient from "../axios-client"
import { useStateContext } from "../contexts/ContextProvider"

export default function DefaultLayout() {
    const {user, token, notification, setUser, setToken} = useStateContext()

    if(!token) {
        return <Navigate to="/react/login" />
    }

    const onLogout = (e) => {
        e.preventDefault()
        axiosClient.post('/api/user/logout')
        .then(() => {
            setUser({})
            setToken(null)
        })
    }

    useEffect(() => {
        axiosClient.get('/api/user')
        .then(({data}) => {
            setUser(data.data)
        })
    }, [])

    return (
        <div id="defaultLayout">
            <aside>
                <Link to="/react/dashboard">Dashboard</Link>
                <Link to="/react/users">Users</Link>
            </aside>
            <div className="content">
                <header>
                    <div>
                        Hi, {user.name}
                    </div>
                    <div onClick={onLogout}>
                        Logout
                    </div>
                </header>
                <main>
                    <Outlet />
                </main>
            </div>

            { notification && <div className="notification">{notification}</div> }
        </div>
    )
}
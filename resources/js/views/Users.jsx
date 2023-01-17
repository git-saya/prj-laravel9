import { useEffect, useState } from "react"
import { Link } from "react-router-dom"
import axiosClient from "../axios-client"
import { useStateContext } from "../contexts/ContextProvider"

export default function Users() {
    const [users, setUsers] = useState([])
    const [loading, setLoading] = useState(false)
    const {setNotification} = useStateContext()

    useEffect(() => {
        getUsers()
    }, [])

    const onDelete = (u) => {
        if(!window.confirm('Are you sure want to delete this user?')) {
            return
        }

        axiosClient.delete(`/api/users/${u.id}`)
            .then(() => {
                setNotification('user was successfully deleted')
                getUsers()
            })
    }

    const getUsers = () => {
        setLoading(true)
        axiosClient.get('/api/users')
        .then((data) => {
            setUsers(data.data.data)
            setLoading(false)
        }).catch(error => {
            setLoading(false)
        })
    }

    return (
        <div>
            <div>
                <h1>Users</h1>
                <Link to="/react/users/new">Add new</Link>
            </div>

            <div className="card animated fadeInDown">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Create Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    {
                        loading && 
                        <tbody>
                            <tr>
                                <td colSpan="5" className="text-center">Loading ....</td>
                            </tr>
                        </tbody>
                    }
                    
                    {
                        !loading && 
                        <tbody>
                        {
                            users.map(u => {
                                return (
                                    <tr key={u.id}>
                                        <td>{u.id}</td>
                                        <td>{u.name}</td>
                                        <td>{u.email}</td>
                                        <td>{u.created_at}</td>
                                        <td>

                                            <Link className="btn-edit" to={'/react/users/'+u.id}>Edit</Link>
                                            &nbsp;
                                            <button onClick={ev => onDelete(u)} className="btn-delete">Delete</button>
                                        </td>
                                    </tr>
                                )
                            })
                        }
                        </tbody>
                    }
                </table>
            </div>
        </div>
    )
}
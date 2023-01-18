import { useEffect, useState } from "react"
import { useNavigate, useParams } from "react-router-dom"
import axiosClient from "../axios-client"
import { useStateContext } from "../Contexts/ContextProvider"


export default function UserForm() {
    const {id} = useParams()
    const navigate = useNavigate()
    const {setNotification} = useStateContext()
    const [errors, setErrors] = useState('')
    const [loading, setLoading] = useState(false)
    const [user, setUser] = useState({
        id: null,
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
    })

    if(id) {
        useEffect(() => {
            setLoading(true)
            axiosClient.get(`/api/users/${id}`).then(({data}) => {
                setLoading(false)
                setUser(data.data)
            }).catch(() => {
                setLoading(false)
            })
        }, [])
    }

    const onSubmit = (e) => {
        e.preventDefault()
        if(user.id) {
            axiosClient.put(`/api/users/${user.id}`, user)
                .then(() => {
                    setNotification('user was successfully updated')
                    navigate('/react/users')
                }).catch((error) => {
                    const response = error.response
                    if(response && response.status === 422) {
                        setErrors(response.data.errors)
                    }
                })
        } else {
            axiosClient.post(`/api/users`, user)
                .then(() => {
                    setNotification('user was successfully created')
                    navigate('/react/users')
                }).catch((error) => {
                    const response = error.response
                    if(response && response.status === 422) {
                        setErrors(response.data.errors)
                    }
                })
        }
    }

    return (
        <>
            { !user.id && <h1>New User</h1> }
            { user.id && <h1>Update User: {user.name} </h1> }
            
            <div className="card animated fadeInDown">
                { loading && (
                    <div className="text-center">Loading ...</div>
                ) }

                { !loading && 
                    <form onSubmit={onSubmit}>
                        <input value={user.name} type="text" onChange={e => setUser({...user, name: e.target.value})} placeholder="Fullname" />
                        {errors.name && <div className="text-danger">{errors.name}</div>}
                        
                        <input value={user.email} type="text" onChange={e => setUser({...user, email: e.target.value})} placeholder="Email" />
                        {errors.email && <div className="text-danger">{errors.email}</div>}

                        <input type="text" onChange={e => setUser({...user, password: e.target.value})} placeholder="Password" />
                        {errors.password && <div className="text-danger">{errors.password}</div>}

                        <input type="text" onChange={e => setUser({...user, password_confirmation: e.target.value})} placeholder="Password Confirmation" />
                        <button type="submit" className="btn">Save</button>
                    </form>
                }
            </div>
        </>
    )
}
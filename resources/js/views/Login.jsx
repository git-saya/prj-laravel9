import { useRef, useState } from "react"
import { Link } from "react-router-dom"
import axiosClient from "../axios-client"
import {useStateContext} from '../contexts/ContextProvider'

export default function Login() {
    const emailRef = useRef()
    const passwordRef = useRef()

    const [errors, setErrors] = useState('')
    const {setUser, setToken} = useStateContext()

    const onSubmit = (ev) => {
        ev.preventDefault()
        const payload = {
            email: emailRef.current.value,
            password: passwordRef.current.value
        }

        setErrors('')

        axiosClient.post('/api/sanctum/token', payload)
        .then(({data}) => {
            setUser(data.user)
            setToken(data.token)
        }).catch(error => {
            const response = error.response
            if(response && response.status === 422) {
                setErrors(response.data.messages)
            }
        })
    }

    return (
        <form onSubmit={onSubmit}>
            <h1 className="title">
                Login into your account.
            </h1>
            <input ref={emailRef} type="text" placeholder="Email" />
            {errors.email && <div className="text-danger">{errors.email}</div>}

            <input ref={passwordRef} type="text" placeholder="Password" />
            {errors.password && <div className="text-danger">{errors.password}</div>}
            <button type="submit" className="btn btn-block">Login</button>
            <p className="message">
                Not registered? <Link to="/react/register">Create an account</Link>
            </p>
        </form>
    )
}
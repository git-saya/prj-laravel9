import { useRef, useState } from "react"
import { Link } from "react-router-dom"
import axiosClient from "../axios-client"
import {useStateContext} from '../contexts/ContextProvider'

export default function Register() {
    const nameRef = useRef()
    const emailRef = useRef()
    const passwordRef = useRef()
    const passwordConfirmationRef = useRef()

    const [errors, setErrors] = useState('')
    const {setUser} = useStateContext()

    const onSubmit = (ev) => {
        ev.preventDefault()
        const payload = {
            name: nameRef.current.value,
            email: emailRef.current.value,
            password: passwordRef.current.value,
            password_confirmation: passwordConfirmationRef.current.value
        }

        setErrors('')

        axiosClient.post('/api/register', payload)
        .then(({data}) => {
            let user = data
            setUser(user)
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
                Signup for free.
            </h1>

            <input ref={nameRef} type="text" placeholder="Fullname" />
            {errors.name && <div className="text-danger">{errors.name}</div>}
            
            <input ref={emailRef} type="text" placeholder="Email" />
            {errors.email && <div className="text-danger">{errors.email}</div>}

            <input ref={passwordRef} type="text" placeholder="Password" />
            {errors.password && <div className="text-danger">{errors.password}</div>}

            <input ref={passwordConfirmationRef} type="text" placeholder="Password Confirmation" />
            <button type="submit" className="btn btn-block">Login</button>
            <p className="message">
                Already registered? <Link to="/react/login">Sign In</Link>
            </p>
        </form>
    )
}
import { Routes, Route, Link } from "react-router-dom"    
import Home from './Home'
import About from './About'
import PageNotFound from './PageNotFound'

export default function Themes() {
    return (
        <div>
            <nav>
                <Link to="/react">Home</Link> | <Link to="/react/about">About</Link>
            </nav>

            <Routes>
                <Route path="/react" element={<Home /> }></Route>    
                <Route path="/react/about" element={<About /> }></Route>    
                {/* 👇️ only match this when no other routes match */}
                <Route path="*" element={<PageNotFound />} />
            </Routes>

            <footer>
                <p>&copy; 2022 - kelas.laravel</p>
            </footer>
        </div>
    )
} 
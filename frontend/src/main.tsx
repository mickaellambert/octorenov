import { createRoot } from 'react-dom/client'
import { createBrowserRouter, RouterProvider } from 'react-router-dom'
import App from './App.tsx'
import Jobs from './pages/Jobs.tsx'
import Job from './pages/Job.tsx'
import './index.css'

const router = createBrowserRouter([
    {
        element: <App />,
        children: [
            {
                path: "/",
                element: <Jobs />
            },
            {
                path: "/jobs/:id",
                element: <Job />
            }
        ]
    }
])

createRoot(document.getElementById('root')!).render(
    <RouterProvider router={router} />
)

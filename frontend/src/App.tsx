import './App.css'
import { Outlet } from 'react-router-dom'

function App() {
  return (
    <>
      <h1>Welcome to the Jobber Application</h1>
      <Outlet />
    </>
  )
}

export default App

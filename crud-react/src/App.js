import './App.css';
import Listar from './componentes/Listar';
import {Routes, Route, Link} from 'react-router-dom';
import Crear from './componentes/Crear';
import Editar from './componentes/Editar';
/* import Venta from './componentes/Venta'; */


function App() {
  return (
    
    <div className="container">
       <nav className="navbar navbar-expand navbar-light bg-light">
            <div className="nav navbar-nav">
                <Link className="nav-item nav-link active" to={"/"}>Sistema <span className="sr-only">(current)</span></Link>
                <Link className="nav-item nav-link" to={"/crear"}>Crear Producto</Link>
                <Link className="nav-item nav-link" to={"/editar"}>Editar Producto</Link>
              {/*   <Link className="nav-item nav-link" to={"/venta"}>Venta Producto</Link> */}
              
            </div>
        </nav>
     <Routes>
        <Route path="/" element={<Listar /> } />
        <Route path="/crear" element={<Crear /> } />
        <Route path="/editar/:id" element={<Editar /> } />
       {/*  <Route path="/venta" element={<Venta /> } /> */}
      </Routes>
   
    </div>
    
  );
}

export default App;

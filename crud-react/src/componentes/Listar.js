import React from 'react';
import {Routes, Route, Link} from 'react-router-dom';

class Listar extends React.Component {
    constructor(props) {
        super(props);
        this.state = { datosCargados:false, productos:[] 
        }
    }
    

    borrarRegistros = (id) =>{

        fetch("http://localhost/ApiCrud/api/delete.php/" + id)
        .then(respuesta=>respuesta.json())
        .then((datosRespuesta)=>{
            console.log(datosRespuesta.body);
            this.cargarDatos();
        })
        .catch(console.log)
 
    }

    cargarDatos(){
        fetch("http://localhost/ApiCrud/api/get.php")
        .then(respuesta=>respuesta.json())
        .then((datosRespuesta)=>{console.log(datosRespuesta.body);
        this.setState({datosCargados:true, productos:datosRespuesta.body})})
        .catch(console.log)

    }

    componentDidMount(){
        this.cargarDatos();
    }

  
    render() { 

        const{datosCargados, productos}=this.state

        if(!datosCargados){
            return(
                <div>...Cargando</div>
            );
        }else{
            return(
                <div className="card">
                    <div className="card-header">
                    <Link type="button" className="btn btn-success" to={"/crear"}>Agregar Producto</Link>
                    </div>
                    <div className="card-body">
                    <h4> Lista de Productos</h4>
                    <table className="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE PRODUCTO</th>
                        <th>REFERENCIA</th>
                        <th>PRECIO</th>
                        <th>PESO</th>
                        <th>CATEGORIA</th>
                        <th>STOCK</th>
                        <th>FECHA DE CREACION</th>

                    </tr>
                </thead>
                <tbody>
                    {
                        productos.map(
                            (producto)=>(
                                <tr key={producto.id}>
                                <td>{producto.id}</td>
                                <td>{producto.nombre_producto}</td>
                                <td>{producto.referencia}</td>
                                <td>{producto.precio}</td>
                                <td>{producto.peso}</td>
                                <td>{producto.categoria}</td>
                                <td>{producto.stock}</td>
                                <td>{producto.fecha_creacion}</td>
                                <td>
                                    <div className="btn-group" role="group" aria-label="">
                                        <Link type="button" className="btn btn-warning" to={"/editar/"+producto.id}>Editar</Link>
                                        <button type="button" className="btn btn-danger"
                                            onClick={()=>this.borrarRegistros(producto.id)}>Borrar</button>
                                        
                                    </div>
                                </td>
        
                            </tr>
                            )
                        )
                    }
                </tbody>
            </table>
                    </div>
                    <div className="card-footer text-muted">
                        
                    </div>
                </div>
            )
        }
        
    }
}
 
export default Listar;
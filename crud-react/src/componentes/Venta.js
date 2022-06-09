/* import React from "react";
import {Routes, Route, Link} from 'react-router-dom';

class Venta extends React.Component {
    constructor(props) {
        super(props);
        this.state = { datosCargados:false, venta:[] }
    }

    cambioValor = (e) =>{
        const state = this.state.venta;
        state[e.target.name] = e.target.value;
        this.setState({ venta:state })
    }

    enviarDatos = (e) =>{
        e.preventDefault();
        console.log("Formulario enviado");
        const{id, id_producto, total,cantidad} = this.state.venta;
        console.log(id);
        console.log(id_producto);
        console.log(total);
        console.log(cantidad);
    

        var datosEnviar = {id_producto:id_producto, total:total,cantidad:cantidad,}
        fetch("http://localhost/ApiCrud/api/update.php",{
            method:"POST",
            body:JSON.stringify(datosEnviar)
        })
        .then(respuesta=>respuesta.json())
        .then((datosRespuesta)=>{console.log(datosRespuesta.body);
            this.props.history.push("/");
        })
        .catch(console.log)
    }
    

    componentDidMount(){

            fetch("http://localhost/ApiCrud/api/createSale.php")
            .then(respuesta=>respuesta.json())
            .then((datosRespuesta)=>{console.log(datosRespuesta.body);
            this.setState({datosCargados:true, producto:datosRespuesta.body[0]})})
            .catch(console.log)
    }
    render() { 
        const{datosCargados, venta} = this.state;

        if(!datosCargados){
            return(
                <div>...Cargando</div>
            );
        }else{
        return (<div className="card">
            <div className="card-header">
                Venta de Productos
            </div>
            <div className="card-body">
               
                
                <form onSubmit={this.enviarDatos}>
                
            
                        <div className="form-group">
                          <label htmlFor="">Nombre:</label>
                          <input type="text" name="id_producto" value={venta.id_producto} id="id_producto" className="form-control" placeholder="" aria-describedby="helpId" />
                          <small id="helpId" className="text-muted">Escribe el nombre del producto</small>
                        </div>
                        <div className="form-group">
                          <label htmlFor="">Referencia:</label>
                          <input type="text" name="referencia"  value={venta.total} id="referencia" className="form-control" placeholder="" aria-describedby="helpId" />
                          <small id="helpId" className="text-muted">Escribe la referencia del producto</small>
                        </div>
                        <div className="form-group">
                          <label htmlFor="">Referencia:</label>
                          <input type="text" name="referencia"  value={venta.cantidad} id="referencia" className="form-control" placeholder="" aria-describedby="helpId" />
                          <small id="helpId" className="text-muted">Escribe la referencia del producto</small>
                        </div>
                      
                        <div className="btn-group" role="group" aria-label="">
                            <button type="submit" className="btn btn-primary">Agregar nuevo producto</button>
                            <Link to={"/"} className="btn btn-danger">Cancelar</Link>
                         
                        </div>
                    </form>
            </div>
        </div> );
        }
    }
}
 
export default Venta; */
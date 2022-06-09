import React from "react";
import {Routes, Route, Link} from 'react-router-dom';

class Crear extends React.Component {
    constructor(props) {
        super(props);
        this.state = { 
            nombre_producto:"",
            referencia:"",
            precio:"",
            peso:"",
            categoria:"",
            stock:""
         }
    }
    
    cambioValor = (e) =>{
        const state = this.state;
        state[e.target.name] = e.target.value;
        this.setState({ state })
    }

    enviarDatos = (e) =>{
        e.preventDefault();
        console.log("Formulario enviado");
        const{nombre_producto,
            referencia,
            precio,
            peso,
            categoria,
            stock} = this.state;

        console.log(nombre_producto);
        console.log(referencia);
        console.log(precio);
        console.log(peso);
        console.log(categoria);
        console.log(stock);

        var datosEnviar = {nombre_producto:nombre_producto, referencia:referencia,precio:precio,peso:peso,categoria:categoria,stock:stock}

        fetch("http://localhost/ApiCrud/api/create.php",{
            method:"POST",
            body:JSON.stringify(datosEnviar)
        })
        .then(respuesta=>respuesta.json())
        .then((datosRespuesta)=>{console.log(datosRespuesta.body);
            this.props.history.push("/");
        })
        .catch(console.log)
    }
    render() { 

        const{nombre_producto,
        referencia,
        precio,
        peso,
        categoria,
        stock} = this.state;

        return ( 
            <div className="card">
                <div className="card-header">
                    Productos
                </div>
                <div className="card-body">
                    <form onSubmit={this.enviarDatos}>
                        <div className="form-group">
                          <label htmlFor="">Nombre:</label>
                          <input type="text" name="nombre_producto" onChange={this.cambioValor} value={nombre_producto} id="nombre_producto" className="form-control" placeholder="" aria-describedby="helpId" />
                          <small id="helpId" className="text-muted">Escribe el nombre del producto</small>
                        </div>
                        <div className="form-group">
                          <label htmlFor="">Referencia:</label>
                          <input type="text" name="referencia" onChange={this.cambioValor} value={referencia} id="referencia" className="form-control" placeholder="" aria-describedby="helpId" />
                          <small id="helpId" className="text-muted">Escribe la referencia del producto</small>
                        </div>
                        <div className="form-group">
                          <label htmlFor="">Precio:</label>
                          <input type="text" name="precio" onChange={this.cambioValor} value={precio} id="precio" className="form-control" placeholder="" aria-describedby="helpId" />
                          <small id="helpId" className="text-muted">Escribe el precio del producto</small>
                        </div>
                        <div className="form-group">
                          <label htmlFor="">Peso (gr):</label>
                          <input type="text" name="peso" onChange={this.cambioValor} value={peso} id="peso" className="form-control" placeholder="" aria-describedby="helpId" />
                          <small id="helpId" className="text-muted">Escribe el peso del producto</small>
                        </div>
                        <div className="form-group">
                          <label htmlFor="">Categoria:</label>
                          <input type="text" name="categoria" onChange={this.cambioValor} value={categoria} id="categoria" className="form-control" placeholder="" aria-describedby="helpId" />
                          <small id="helpId" className="text-muted">Escribe la categoria del producto</small>
                        </div>
                        <div className="form-group">
                          <label htmlFor="">Stock:</label>
                          <input type="text" name="stock" onChange={this.cambioValor} value={stock} id="stock" className="form-control" placeholder="" aria-describedby="helpId" />
                          <small id="helpId" className="text-muted">Escribe el numero de stock del producto</small>
                        </div>
                        <div className="btn-group" role="group" aria-label="">
                            <button type="submit" className="btn btn-primary">Agregar nuevo producto</button>
                            <Link to={"/"} className="btn btn-danger">Cancelar</Link>
                         
                        </div>
                    </form>
                </div>
                <div className="card-footer text-muted">
                    
                </div>
            </div>
        );
    }
}
 
export default Crear;
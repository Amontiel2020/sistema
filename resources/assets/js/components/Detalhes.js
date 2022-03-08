import React, { Component, useState } from "react";
import ReactDOM from "react-dom";

//const [id,task,completed]=useState({todo});
export default class Detalhes extends Component {
  constructor(props) {
    super(props);
    // this.setState({ todo: this.props.todo });
  }
  render() {
    if(this.props.pagamento_marcado.valor!=null){
      return (
        <div className="card">
        <div className="card-body">
          <h3 className="card-title">Detalhes</h3>

          <ul className="list-group">
            <li className="list-group-item list-group-item-success"> Valor:  {this.props.pagamento_marcado.valor}</li>
            <li className="list-group-item list-group-item-success"> Taxa:  {this.props.pagamento_marcado.taxa}</li>
            <li className="list-group-item list-group-item-success"> Data:  {this.props.pagamento_marcado.created_at}</li>

            </ul>
        </div>
        </div>
      
    );
    }else{
      return null;
    }

  }
}

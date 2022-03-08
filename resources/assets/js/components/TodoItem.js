import React, { Component, useState } from "react";
import ReactDOM from "react-dom";

//const [id,task,completed]=useState({todo});
export default class TodoItem extends Component {
  constructor(props) {
    super(props);
    this.state = {
        pagamento: true
        
      };
  
      this.handleInputChange = this.handleInputChange.bind(this);
  }
  handleInputChange(event) {
    const target = event.target;
    const value = target.type === 'checkbox' ? target.checked : target.value;
    const name = target.name;
    this.setState({ [name]: value });
   
   
  }
  render() {
    return (
      <li key={this.props.todo.id}>Mes: {this.props.todo.mes}  Ano: {this.props.todo.ano}</li>
     );
  }
}
{ /*  
  <div className="card">
    <div className="card-header">Mes: {this.props.todo.mes} <span align="right"><input name="pagamento" type="checkbox" value={this.props.todo.id} onChange={this.handleInputChange} /></span>
   
    </div>

    <div className="card-body">
    <ul className="list-group">
      <li className="list-group-item list-group-item-success"> Valor:  {this.props.todo.valor}</li>
      <li className="list-group-item list-group-item-success"> Taxa:  {this.props.todo.taxa}</li>
      <li className="list-group-item list-group-item-success"> Data:  {this.props.todo.created_at}</li>

      </ul>
    
    </div>
  </div>
*/ }
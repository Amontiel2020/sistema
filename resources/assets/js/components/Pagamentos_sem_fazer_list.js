import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import TodoItem from "./TodoItem";

//const todos={todos};
export default class Pagamentos_sem_fazer_list extends Component {
  constructor(props) {
    super(props);
     // this.setState({  pagamento_marcado:{} });
    this.handlePagamentoMarcado = this.handlePagamentoMarcado.bind(this);
  }

  handlePagamentoMarcado(selection) {
   // this.setState({ pagamento_marcado: selection });
   // alert(selection);
    const { handlePagamentoMarcadoIndex } = this.props;
    handlePagamentoMarcadoIndex(selection);
   
  }
  render() {
    return (
       
        <div className="row" >
          {this.props.todos.map((todo) => (
            <Fazer_pagamento_Item handlePagamentoMarcado={this.handlePagamentoMarcado} key={todo.id} todo={todo} />
          ))}
        </div>
       

     
    );
  }
}

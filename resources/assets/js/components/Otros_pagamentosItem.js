import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import Mostrar_emolumento from "./Mostrar_emolumento";

//const [id,task,completed]=useState({todo});
export default class Outros_pagamentosItem extends Component {
  constructor(props) {
    super(props);
    this.state = {
      pagamento: true,
    };
   

  }

  render() {
    return (
      <tr>
        <td> {this.props.pagamento.data}</td>
        <td> {this.props.pagamento.nome}</td>
        <td> {this.props.pagamento.valor}</td>
        <td> {this.props.pagamento.obs}</td>
        <td> {this.props.pagamento.descrip}</td>

      </tr>
    );
  }
}

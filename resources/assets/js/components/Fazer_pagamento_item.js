import React, { Component, useState } from "react";
import ReactDOM from "react-dom";

//const [id,task,completed]=useState({todo});
export default class Fazer_pagamento_item extends Component {
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
    this.setState({
      [name]: value    });

      const { handlePagamentoMarcado } = this.props;
      handlePagamentoMarcado(target.value);
  }
  render() {
    return (
        <a href="#">
        <label className={"badge small bg-gradient " + this.state.fondo}>
          {this.state.nome}
        </label>
      </a>
    );
  }
}

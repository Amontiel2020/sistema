import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import Option_estudante from "./Option_estudante";
import axios from "axios";


//const todos={todos};
export default class Pagamento extends Component {
  constructor(props) {
    super(props);
    this.state = {pagamentos:[],mes:0,taxa:0 };
   // this.handleSelectChange = this.handleSelectChange.bind(this);
   // this.handleClick = this.handleClick.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleSelectMesChange = this.handleSelectMesChange.bind(this);
    this.handleSelectTaxaChange = this.handleSelectTaxaChange.bind(this);

  }
 /* handleSelectChange(e) {
    const { handleSeleccionado } = this.props;

    this.setState({ selection: e.target.value });
    const { selection } = this.state;
    handleSeleccionado(selection);
  }*/
  handleSelectMesChange(e){
      this.setState({mes:e.target.value});
  }
  handleSelectTaxaChange(e){
    this.setState({taxa:e.target.value});
}
handleActualizarLista() {
    const { handleActualizarLista } = this.props;
    const { pagamentos } = this.state;
    handleActualizarLista(pagamentos);
  }

  handleSubmit(e) {
    e.preventDefault();
   // alert(this.props.selection);
   
    var bodyFormData = new FormData();
    bodyFormData.set('estudante_id', this.props.selection);
    bodyFormData.set('mes', this.state.mes);
    bodyFormData.set('taxa', this.state.taxa);

    axios.post(`http://192.168.10.150/api/save_pagamento`,bodyFormData).then((res) => {
        getPagamentos(this.props.selection);
        handleActualizarLista();
      
      });
     
  }

  getPagamentos(selection) {
    // const {selection} =  this.state;

    axios
      .get(`http://192.168.10.150/api/pagamentos_react/${selection}`)
      .then((res) => {
        const lista = res.data;
        this.setState({ pagamentos: lista });

      });
  }
  render() {
    return (
     
      <form className="form-inline"  onSubmit={this.handleSubmit}>
    
        <select onChange={this.handleSelectMesChange} >
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
        <select onChange={this.handleSelectTaxaChange} >
          <option value="1250">1250</option>
          <option value="2500">2500</option>
          <option value="3750">3750</option>
          <option value="5000">5000</option>
        </select>
        <button type="submit"  className="btn btn-primary">Enviar</button>
        </form>
     
    );
  }
}

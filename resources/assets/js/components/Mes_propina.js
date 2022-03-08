import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import "./estilos.css";

//const [id,task,completed]=useState({todo});
export default class Mes_propina extends Component {
  constructor(props) {
    super(props);
    this.state = {
      pagamento: {},
      nome: "",
      estudante: {},
      fondo: "bg-info",
      activo: true,
    };

     this.handleMes_propinaClick = this.handleMes_propinaClick.bind(this);
  }

  handleSubmit(e) {
    e.preventDefault();
    
   
    var bodyFormData = new FormData();
    bodyFormData.set('estudante_id', this.props.estudante_id);
    bodyFormData.set('mes', this.state.mes);
    bodyFormData.set('taxa', this.state.taxa);

    axios.post(`http://192.168.10.150/api/save_pagamento`,bodyFormData).then((res) => {
        getPagamentos(this.props.selection);
        handleActualizarLista();
      
      });
     
  }
  componentWillReceiveProps(newProps) {
    if (newProps.pagamento.valor != null) {
      this.setState({ fondo: "bg-success" });
      this.setState({ activo: false });
    } else if (newProps.pagamento.valor == null) {
      this.setState({ fondo: "bg-info" });
      this.setState({ activo: true });
    }
    const mes = newProps.pagamento.mes;
    //console.log("mes del switch  "+mes);
    switch (mes) {
      case "1":
        this.setState({ nome: "Out" });
        break;
      case "2":
        this.setState({ nome: "Nov" });
        break;
      case "3":
        this.setState({ nome: "Dez" });
        break;
      case "4":
        this.setState({ nome: "Jan" });
        break;
      case "5":
        this.setState({ nome: "Fev" });
        break;
      case "6":
        this.setState({ nome: "Mar" });
        break;
      case "7":
        this.setState({ nome: "Abr" });
        break;
      case "8":
        this.setState({ nome: "Mai" });
        break;
      case "9":
        this.setState({ nome: "Jun" });
        break;
      case "10":
        this.setState({ nome: "Jul" });
        break;

      default:
        break;
    }
    /*const estudante = newProps.estudante;
    if (this.props.estudante.id != newProps.estudante.id) {
      this.getPagamento(estudante.id, newProps.mes);
      const { pagamento } = this.state.pagamento;
      console.log("Pagamento: " + this.state.pagamento.valor);
      if (this.state.pagamento.valor != null) {
        this.setState({ fondo: "bg-danger" });
      }
    }*/
  }
  handleMes_propinaClick(e){
   
    this.setState({ activo: false });
  const { handlePagamentoTemp } = this.props;
  const pagamento  = this.props.pagamento;
 // const index=this.props.index;
  handlePagamentoTemp(pagamento);
  
  
  }
  componentWillMount() {
    // this.getPagamentos(this.state.selection);
  }
  render() {
    if (this.state.activo == true) {
      return (
        <div className="col-1">
          <label className={"badge small bg-gradient " + this.state.fondo}>
            <span className="mes_propina"  value={this.state.nome} onClick={this.handleMes_propinaClick}>
              {" "}
              {this.state.nome}
            </span>
          </label>
        </div>
      );
    }
    if (this.state.activo == false) {
      return (
        <div className="col-1">
          <label className={"badge small bg-gradient " + this.state.fondo}>
           
              {" "}
              {this.state.nome}
         
          </label>
        </div>
      );
    }
  }
}

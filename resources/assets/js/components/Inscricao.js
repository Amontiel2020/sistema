import { divide } from "lodash";
import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import ModalRegistrarInscricao from "./ModalRegistrarInscricao";

export default class Inscricao extends Component {
  constructor(props) {
    super(props);
    this.state = {
      show: false,
      estudanteSel: null
    };
    this.showModal = this.showModal.bind(this);
    this.hideModal = this.hideModal.bind(this);
    this.handleSave = this.handleSave.bind(this);
    this.getInscricoes=this.getInscricoes.bind(this);
  }

  showModal(id) {
    this.setState({ show: true });
    // const result = this.state.inscricoes.find((item) => item.id == id);
    //  this.setState({ inscricaoSel: result });
    // this.getDiscInscricao(result.id);
  }
  hideModal() {
    this.setState({ show: false });
  }
  /*onChangeAnoCurricular(e){
      const anoCurricular=e.target.value;
      this.setState({anoCurricular:anoCurricular})
     
  }*/
  getInscricoes(estudante_id) {
    const { getInscricoes } = this.props;
    getInscricoes(estudante_id);
  }

  handleSave(estudante, anoCurricular, sem, anoAcad) {
    var bodyFormData = new FormData();

    bodyFormData.set("estudante_id", estudante.id);
    bodyFormData.set("anoCurricular", anoCurricular);
    bodyFormData.set("sem", sem);
    bodyFormData.set("anoAcad", anoAcad);
    alert(anoCurricular);

    /*axios
      .post(`http://192.168.10.150/api/addInscricao`, bodyFormData)
      .then((res) => {
        console.log("Inscricao inserida correctamente");
        this.getInscricoes(estudante.id);
      });*/
    this.hideModal();
   
  }

  render() {
    return (
      <div className="item-a">
        {this.props.estudante ? <p>{this.props.estudante.nome}</p> : ""}
        <button onClick={this.showModal} className="btn btn-primary btn-sm">
          Registrar Inscricao
        </button>
        <ModalRegistrarInscricao
          show={this.state.show}
          handleClose={this.hideModal}
          handleSave={this.handleSave}
          estudanteSel={this.props.estudante}
        />
      </div>
    );
  }
}

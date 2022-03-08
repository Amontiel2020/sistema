import React, { Component } from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import Select_est from "./Select_est";
import DadosConta from "./DadosConta";

import "./componenteMatriculas.css";
import "bootstrap/dist/css/bootstrap.min.css";
import TableInscricoes from "./tableInscricoes";
import ModalDisciplinaMatriculas from "./ModalDisciplinasMatricula";
import ModalDelete from "./ModalDelete";
import Inscricao from "./Inscricao";
import Async_select from "./Async_select";


export default class ComponenteMatriculas extends Component {
  constructor(props) {
    super(props);
    this.state = {
      show: false,
      estudanteSel: null,
      inscricoes: null,
      inscricaoSel: null,
      discInscricao: [],
      discParaInscricao:[],
      indexDelete: null,
      showDelete: false,

    };
    this.getEstudante = this.getEstudante.bind(this);
    this.getInscricoes = this.getInscricoes.bind(this);
    this.getDiscInscricao = this.getDiscInscricao.bind(this);
    this.getDiscParaInscricao = this.getDiscParaInscricao.bind(this);
    
    


    this.showModal = this.showModal.bind(this);
    this.hideModal = this.hideModal.bind(this);
    this.confirmDelete = this.confirmDelete.bind(this);
    this.setInscricoes = this.setInscricoes.bind(this);
    this.deleteItem = this.deleteItem.bind(this);
    this.showModalDelete = this.showModalDelete.bind(this);
    this.hideModalDelete = this.hideModalDelete.bind(this);
    this.deleteInscricao=this.deleteInscricao.bind(this);
    this.getInscricoes=this.getInscricoes.bind(this);

  }

  getEstudante(selection) {
    axios
      .get(`http://192.168.10.150/api/getEstudante/${selection}`)
      .then((res) => {
        const estudante = res.data;
        //console.log(estudante);
        this.setState({ estudanteSel: estudante });
        this.getInscricoes(this.state.estudanteSel.id);
      });
  }
  getInscricoes(idEstudante) {
    axios
      .get(`http://192.168.10.150/api/getInscricoes/${idEstudante}`)
      .then((res) => {
        const inscricoes = res.data;
        //console.log(estudante);
        this.setState({ inscricoes: inscricoes });
        // this.getPagamentos(this.state.estudanteSel.id);
      });
  }
  getDiscInscricao(idInscricao) {
    axios
      .get(`http://192.168.10.150/api/getDiscInscricao/${idInscricao}`)
      .then((res) => {
        const disciplinas = res.data;
        // console.log(disciplinas);
        this.setState({ discInscricao: disciplinas });
        // this.getPagamentos(this.state.estudanteSel.id);
      });
  }
  getDiscParaInscricao(idInscricao) {
    axios
      .get(`http://192.168.10.150/api/getDiscParaInscricao/${idInscricao}`)
      .then((res) => {
        const disciplinas = res.data;
        // console.log(disciplinas);
        this.setState({ discParaInscricao: disciplinas });
        // this.getPagamentos(this.state.estudanteSel.id);
      });
  }
  deleteInscricao(idInscricao,estudanteSel) {
    axios
      .get(`http://192.168.10.150/api/deleteInscricao/${idInscricao}/${estudanteSel}`)
      .then((res) => {
        console.log("eliminado");
       // const disciplinas = res.data;
        // console.log(disciplinas);
       // this.setState({ discInscricao: disciplinas });
        // this.getPagamentos(this.state.estudanteSel.id);
      });
  }


  showModal(id) {
    this.setState({ show: true });
    const result = this.state.inscricoes.find((item) => item.id == id);
    this.setState({ inscricaoSel: result });
    this.getDiscInscricao(result.id);
    this.getDiscParaInscricao(result.id);

  }
  hideModal() {
    this.setState({ show: false });
    // this.actualizarTotal(this.state.taxaTemp);
  }
  confirmDelete() {
    this.deleteInscricao(this.state.indexDelete,this.state.estudanteSel.id);
    var i = this.state.inscricoes.findIndex(
      (x) => x.id == this.state.indexDelete
    );
    var listaInscricoes = [...this.state.inscricoes];
    listaInscricoes.splice(i, 1);
    this.setInscricoes(listaInscricoes);
    this.setState({ indexDelete: null });
   
    this.hideModalDelete();
  }
  setInscricoes(inscricoes) {
    this.setState({ inscricoes: inscricoes });
  }
  deleteItem(index) {
    this.showModalDelete();
    this.setState({ indexDelete: index });
  }
  showModalDelete(index) {
    this.setState({ showDelete: true });
    this.setState({ indexDelete: index });
  }
  hideModalDelete() {
    this.setState({ showDelete: false });
  }

  render() {
    return (
      <div>
        <div className="wrapper">
          <div className="box header">
            {" "}
            <Async_select/>
            <Select_est getEstudante={this.getEstudante} />
          </div>

          <div className="box content">
            {" "}
            <DadosConta estudante={this.state.estudanteSel} />
          </div>
          <div className=" box barra">
       <Inscricao getInscricoes={this.getInscricoes} estudante={this.state.estudanteSel} />
          </div>
          <div className="box sidebar">

            <TableInscricoes
              inscricoes={this.state.inscricoes}
              showModal={this.showModal}
              deleteItem={this.deleteItem}
             
            />
          </div>
        </div>

        <ModalDisciplinaMatriculas
          show={this.state.show}
          disciplinas={this.state.discInscricao}
          disciplinasParaInscricao={this.state.discParaInscricao}

          handleClose={this.hideModal}
          inscricaoSel={this.state.inscricaoSel}
          getDiscInscricao={this.getDiscInscricao}
         
        />
        <ModalDelete
          show={this.state.showDelete}
          handleClose={this.hideModalDelete}
          confirmDelete={this.confirmDelete}
        />
      </div>
    );
  }
}
if (document.getElementById("moduloMatriculas")) {
  ReactDOM.render(
    <ComponenteMatriculas />,
    document.getElementById("moduloMatriculas")
  );
}

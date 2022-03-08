import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import Option_estudante from "./Option_estudante";
import ItemDiscInscricao from "./ItemDiscInscricao";
import Export from "./Export";
import axios from "axios";


import { BsCardList } from "react-icons/bs";

//const todos={todos};
export default class TableDisciplinasInscricao extends Component {
  constructor(props) {
    super(props);
    this.state = {
      listaDisciplinas: []
     // inscricao:props.inscricaoSel
    };

    this.deleteItem = this.deleteItem.bind(this);
    this.addDisciplina = this.addDisciplina.bind(this);
    this.deleteDisciplina = this.deleteDisciplina.bind(this);
    this.salvarDisciplinas = this.salvarDisciplinas.bind(this);
    this.getDiscInscricao = this.getDiscInscricao.bind(this);

    


    // this.setTotal = this.setTotal.bind(this);
    this.showModal = this.showModal.bind(this);
    // this.setTotal = this.setTotal.bind(this);
  }

  addDisciplina(id) {
   // alert(id);
    this.setState((previousState) => ({
      listaDisciplinas: [...previousState.listaDisciplinas, id]
    }));
  }

  deleteDisciplina(id){
    var i = this.state.listaDisciplinas.findIndex((x) => x == id);
    var listaDisciplinas = [...this.state.listaDisciplinas];
    listaDisciplinas.splice(i, 1);
    this.setState({ listaDisciplinas: listaDisciplinas });
  }
  salvarDisciplinas(){
   // alert(this.props.inscricaoSel.id);
    var bodyFormData = new FormData();

    bodyFormData.set("listaDisciplinas", this.state.listaDisciplinas);
    bodyFormData.set("inscricao", this.props.inscricaoSel.id);
  

    axios
      .post(`http://192.168.10.150/api/addDisciplinasInscricao`, bodyFormData)
      .then((res) => {
        this.getDiscInscricao(this.props.inscricaoSel.id);
       console.log("disciplinas inseridas correctamente");
       
      });
  }

  deleteItem(id) {
    const { deleteItem } = this.props;
    deleteItem(id);
  }

  showModal(id) {
    const { showModal } = this.props;
    showModal(id);
    //this.setState({ nome: nome,punit:punit,qtd:qtd,taxa:taxa,valor:valor
  }

  componentDidUpdate(newProps) {
    //console.log("props itens",newProps.itens);
    //console.log("newProps itens",newProps.itens);
    if (newProps != this.props) {
      //  this.setState({itens:newProps.itens})
      // this.setTotal();
    }
  }
  getDiscInscricao(id){
    const {getDiscInscricao}=this.props;
    getDiscInscricao(id);
  }

  render() {
    return (
      <div className="row">
        <div className="col-5">
          {this.props.disciplinasParaInscricao != null && (
            <table className="table table-bordered table-striped">
              <thead>
                <tr>
                  <th></th>
                  <th>Nome</th>
                </tr>
              </thead>
              <tbody>
                {this.props.disciplinasParaInscricao.map((item, i) => (
                  <ItemDiscInscricao
                    key={i}
                    id={item.id}
                    nome={item.nome}
                    addDisciplina={this.addDisciplina}
                    deleteDisciplina={this.deleteDisciplina}

                  />
                ))}
              </tbody>
            </table>
          )}
        </div>
        <div className="col-2">
          <p>
            <button className="btn btn-primary" onClick={this.salvarDisciplinas}>+</button>
          </p>
          <p>
            <button className="btn btn-primary">-</button>
          </p>
        </div>
        <div className="col-5">
          {this.props.disciplinas != null && (
            <table className="table table-bordered table-striped">
              <thead>
                <tr>
                  <th></th>
                  <th>Nome</th>
                </tr>
              </thead>
              <tbody>
                {this.props.disciplinas.map((item, i) => (
                  <ItemDiscInscricao key={i} id={item.id} nome={item.nome} />
                ))}
              </tbody>
            </table>
          )}
        </div>
      </div>
    );
  }
}

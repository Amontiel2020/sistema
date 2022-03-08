import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import Option_estudante from "./Option_estudante";
import ItemInscricao from "./ItemInscricao";
import Export from "./Export";

import { BsCardList } from "react-icons/bs";

//const todos={todos};
export default class TableInscricoes extends Component {
  constructor(props) {
    super(props);
    this.state = {
      nome: "",
      punit: "",
      qtd: "",
      taxa: "",
      desc: "",
      valor: "",
      total: 0
    };

    this.state = { inscricoes: [], total: 0 };

    this.deleteItem = this.deleteItem.bind(this);
    // this.setTotal = this.setTotal.bind(this);
    this.showModal = this.showModal.bind(this);
    // this.setTotal = this.setTotal.bind(this);
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



  render() {
    return (
      <div>
        <div>
          {this.props.inscricoes != null && (
            <table className="table table-bordered table-striped">
              <thead>
                <tr>
                  <th></th>
                  <th>Ano Academico</th>
                  <th>Data</th>
                  <th>Curso</th>            
                  <th>Ano curricular</th>
                  <th>Semestre</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                {this.props.inscricoes.map((item, i) => (
                  <ItemInscricao
                    key={i}
                    id={item.id}
                    data={item.created_at}
                    curso_id={item.curso_id}
                    anoCurricular={item.anoCurricular}
                    semestre={item.semestre}
                    anoAcademico={item.anoAcademico}
                    showModal={this.showModal}
                    deleteItem={this.deleteItem}
                  />
                ))}
                <tr>
                  <td align="right" colSpan="8" style={{ fontSize: "15px" }}>
                    <span>Total: </span>
                  </td>
                </tr>
              </tbody>
            </table>
          )}

          <div></div>
        </div>
      </div>
    );
  }
}

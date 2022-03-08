import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import Option_estudante from "./Option_estudante";
import TableItem from "./TableItem";
import Export from "./Export";

import { BsCardList } from "react-icons/bs";

//const todos={todos};
export default class TableItens extends Component {
  constructor(props) {
    super(props);
    this.state = {
      nome: "",
      punit: "",
      qtd: "",
      taxa: "",
      desc: "",
      valor: "",
      total:0
    };

    this.state = { itens: [], total: 0 };

    this.deleteItem = this.deleteItem.bind(this);
   // this.setTotal = this.setTotal.bind(this);
    this.showModal = this.showModal.bind(this);
    this.setTotal = this.setTotal.bind(this);

  }

  setTotal() {
   
    const total = this.props.itens.reduce(
      (total, currentValue) => (total = total + currentValue.valor),
      0
    );
    this.setState({ total: total });
   
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
      this.setTotal();
    }
  }

  render() {
    return (
      <div>
        {this.props.itens.length != 0 && (
          <div>
            <table className="table table-bordered table-striped">
            <thead>
              <tr>
                <th></th>
                <th>Descrição</th>
                <th>P.Unit</th>
                <th>Qtd</th>
                <th>Taxa</th>
                <th>Desconto</th>
                <th>Forma de Pago</th>
                <th>Total</th>
              </tr>
              </thead>
              <tbody>
                {this.props.itens.map((item, i) => (
                  <TableItem
                    key={i}
                    id={item.id}
                    nome={item.nome}
                    punit={item.punit}
                    qtd={item.qtd}
                    taxa={item.taxa}
                    desc={item.desc}
                    obs={item.obs}
                    valor={item.valor}
                    ano={item.ano}
                    deleteItem={this.deleteItem}
                    showModal={this.showModal}
                  />
                ))}
                <tr>
                  <td align="right" colSpan="8" style={{ fontSize: "15px" }}>
                    <span >
                      Total:{" "}
                      {new Intl.NumberFormat("pt-PT", {
                        minimumFractionDigits: 2
                      }).format(this.state.total)} {"Kz"}
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
            <div>
          
              <button onClick={this.props.showModalConfirmFactura} className="btn btn-primary btn-sm">Gerar factura</button>
            </div>
          </div>
        )}
        {this.props.itens.length == 0 && (
          <div>
            {" "}
            <div className="text-center">
              {" "}
              <BsCardList size={50} />
            </div>
            <p className="text-center">
              Não existem itens associados ao documento.
            </p>
          </div>
        )}
      </div>
    );
  }
}

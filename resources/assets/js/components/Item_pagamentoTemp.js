import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import { BsArrowRepeat } from "react-icons/bs";
import { BsFillXCircleFill } from "react-icons/bs";

//const [id,task,completed]=useState({todo});
export default class Item_pagamentoTemp extends Component {
  constructor(props) {
    super(props);

    this.state = {
      pagamento: true,
      taxa: 0,
    };

    this.handledOnClick = this.handledOnClick.bind(this);
    this.handleUpdatePagamentoTemp = this.handleUpdatePagamentoTemp.bind(this);
  }

  handledOnClick(e) {
    // alert(e.target);
    // const element=li>e.target
    //console.log(e.target);
    const { handledOnClick } = this.props;
    handledOnClick(e.target.id);
  }
  handleUpdatePagamentoTemp(e) {
        
    var bodyFormData = new FormData();
    bodyFormData.set("id", this.props.pagamento.id);
    bodyFormData.set("taxa", e.target.value);


    const { handleUpdatePagamentoTemp } = this.props;
    handleUpdatePagamentoTemp(bodyFormData);
  }



  render() {
    return (
      <div className="card" key={this.props.index}>
        <div className="card-header">
          <div className="row">
            <div className="col-md-10">
              <span>
                <b>Mes: {this.props.pagamento.mes}</b>
              </span>
            </div>
            <div className="col-md-2">
              <BsFillXCircleFill />
            </div>
          </div>
        </div>
        <div className="card-body">
          <form >
            <div className="row">
              <div className="col-md-6">Valor:</div>
              <div className="col-md-6">{this.props.pagamento.valor}</div>
            </div>
            <div className="row">
              <div className="col-md-4">Taxa:</div>
              <div className="col-md-8">
                <div className="row">
                  <div className="col-md-9">
                    <input
                      className="form-control"
                      type="text"
                      value={this.state.taxa}
                      onChange={this.handleUpdatePagamentoTemp}
                    />
                  </div>
                  <div className="col-md-3">
                    <BsArrowRepeat />
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>

        <div className="card-footer">
          <div className="row">
            <div className="col-md-12">
              <button
                id={this.props.pagamento.id}
                onClick={this.handledOnClick}
                className="btn btn-danger btn-sm btn-block"
              >
                Eliminar
              </button>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

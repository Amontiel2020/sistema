import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import Mes_propina from "./Mes_propina";
import Select_emolumentos from "./Select_emolumentos";

import axios from "axios";


export default class PagamentosSemFazer extends Component {
  constructor(props) {
    super(props);
    this.state={ emolumentos: []}
    this.handlePagamentoTemp = this.handlePagamentoTemp.bind(this);
    this.getEmolumentos = this.getEmolumentos.bind(this);


  }
  handlePagamentoTemp(p) {
    const { handlePagamentoTemp } = this.props;
    handlePagamentoTemp(p);
  }

  getEmolumentos() {
    axios.get(`http://192.168.10.150/api/lista_emolumentos`).then((res) => {
      const emolumentos = res.data;
      this.setState({ emolumentos: emolumentos });
    });
  }
  componentWillMount() {
    this.getEmolumentos();
  }

  render() {
    if (this.props.pagamentos != "") {
      return (
        
        <div className="card">
          <div className="card-body">
            <div className="row">
              {this.props.pagamentos.map((pagamento, index) => (
                <Mes_propina
                  key={index}
                  index={index}
                  pagamento={pagamento}
                  handlePagamentoTemp={this.handlePagamentoTemp}
                />
              ))}
            </div>
          </div>
         <div>
         <Select_emolumentos emolumentos={this.state.emolumentos} />
         </div>

        </div>
       
       
      );
    } else {
      return null;
    }
  }
}

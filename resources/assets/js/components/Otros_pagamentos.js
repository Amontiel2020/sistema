import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import Otros_pagamentosItem from "./Otros_pagamentosItem";

//const todos={todos};
export default class Otros_pagamentos extends Component {
  constructor(props) {
    super(props);
  }

  render() {
    if (this.props.pagamentos != "") {
      return (
        <div className="card">
          <div className="card-body">
            <table className="table table-bordered table-striped">
              <thead>
                <tr>
                <th>Data</th>
                 <th>Designação</th>
                  <th>Valor</th>
                  <th>Meio Pagamento</th>
                  <th>Obs</th>

                </tr>
              </thead>
              <tbody>
                {this.props.pagamentos.map((pagamento) => (
                  <Otros_pagamentosItem
                    key={pagamento.id}
                    pagamento={pagamento}
                  />
                ))}
              </tbody>
            </table>
          </div>
        </div>
      );
    } else {
      return null;
    }
  }
}

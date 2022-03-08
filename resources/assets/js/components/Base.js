import React, { Component } from "react";

import "./estilos.css";

export default class Base extends Component {
  constructor(props) {
    super(props);
    this.state = {};
  }
  render() {
    return (
      <main className="grid">
        <div className="head">
          
        </div>
        <div className="main">Itens</div>
        <div className="side">Definições do documento</div>
        <div className="footer">Observações</div>
      </main>
    );
  }
}

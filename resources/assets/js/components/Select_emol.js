import React, { Component, useState } from "react";
import axios from "axios";

export default class Select_emol extends Component {
  constructor(props) {
    super(props);
    this.state = { emolumentos: [] };
    this.seleccionado = this.seleccionado.bind(this);
  }
  // get all estudantes from backend
  getEmolumentos() {
    axios.get(`http://192.168.10.150/api/emolumentos`).then((res) => {
      const emolumentos = res.data;
      this.setState({ emolumentos: emolumentos });
    });
  }
  seleccionado(e) {
    const { seleccionado } = this.props;
    seleccionado(e.target.value);
  }
  componentWillMount() {
    this.getEmolumentos();
  }
  render() {
    return (
      <select className="form-control" onChange={this.seleccionado}>
        {this.state.emolumentos.map((emolumento) => (
          <option value={emolumento.id} key={emolumento.id}>
            {emolumento.nome} {new Intl.NumberFormat({style:'currency',currency:'AOA'}).format(emolumento.valor)}
          </option>
        ))}
      </select>
    );
  }
}

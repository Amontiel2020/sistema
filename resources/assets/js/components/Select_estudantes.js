import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import Option_estudante from "./Option_estudante";



//const todos={todos};
export default class Select_estudantes extends Component {
  constructor(props) {
    super(props);
    this.state = { selection: 0 };
    this.handleSelectChange = this.handleSelectChange.bind(this);
    this.handleClick = this.handleClick.bind(this);
  }
  handleSelectChange(e) {
    const { handleSeleccionado } = this.props;

    this.setState({ selection: e.target.value });
    //console.log(e.target.value);
    //const { selection } = this.state;
    handleSeleccionado(e.target.value);
  }
  handleClick(e) {
    alert(e);
  }
  render() {
    return (
      <div className="card">
        <div className="card-body">
                <select onChange={this.handleSelectChange} className="form-control">
            {this.props.estudantes.map((estudante) => (
              <option value={estudante.id} key={estudante.id}>
                {estudante.nome}
              </option>
            ))}
          </select>
        </div>
      </div>
    );
  }
}

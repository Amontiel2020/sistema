import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import Option_estudante from "./Option_estudante";



//const todos={todos};
export default class Select_cursos extends Component {
  constructor(props) {
    super(props);
    this.state = { selection: 0 };
    this.handleSelectCursoChange = this.handleSelectCursoChange.bind(this);
    this.handleClick = this.handleClick.bind(this);
  }
  handleSelectCursoChange(e) {
    const { handleSelectCursoChange } = this.props;
    handleSelectCursoChange(e.target.value);
  }
  handleClick(e) {
    alert(e);
  }
  render() {
    return (
      <div className="card">
        <div className="card-body">
                <select onChange={this.handleSelectCursoChange} className="form-control">
              
            {this.props.cursos.map((curso) => (
              <option value={curso.id} key={curso.id}>
                {curso.nome}
              </option>
            ))}
          </select>
        </div>
      </div>
    );
  }
}

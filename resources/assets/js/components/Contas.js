import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import Select_cursos from "./Select_cursos";
import Item_conta from "./Item_conta";

import "./estilos.css";

import axios from "axios";

//const [id,task,completed]=useState({todo});
export default class Contas extends Component {
  constructor(props) {
    super(props);

    this.handleSelectCursoChange = this.handleSelectCursoChange.bind(this);
    this.handleSelectTurmaChange = this.handleSelectTurmaChange.bind(this);
    this.def_selection = this.def_selection.bind(this);


  }

  handleSelectCursoChange(selection) {
    const { handleCursoMarcado } = this.props;
    handleCursoMarcado(selection);
  }
  handleSelectTurmaChange(e) {
    const { handleTurmaMarcada } = this.props;
    handleTurmaMarcada(e.target.value);
  }
  def_selection(estudante_id) {
    const { def_selection } = this.props;
    def_selection(estudante_id);
  }
  

  render() {
    return (
      <div className="card">
        <div className="card-body">
          <h3 className="card-title">Contas</h3>
          <Select_cursos
            handleSelectCursoChange={this.handleSelectCursoChange}
            cursos={this.props.cursos}
          />
          <div className="card">
            <div className="card-body">
              <select
                onChange={this.handleSelectTurmaChange}
                className="form-control"
              >
                {this.props.turmas.map((turma) => (
                  <option value={turma.id} key={turma.id}>
                    {turma.identificador}
                  </option>
                ))}
              </select>
            </div>
          </div>
          <ul className="list-group">
            {this.props.estudantes.map((estudante) => (
              <Item_conta estudante={estudante} def_selection={this.def_selection} />
            ))}
          </ul>
        </div>
      </div>
    );
  }
}

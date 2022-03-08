import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import Mostrar_curso from "./Mostrar_curso";
import Mostrar_turma from "./Mostrar_turma";

import "./estilos.css";

//const [id,task,completed]=useState({todo});
export default class DadosConta extends Component {
  constructor(props) {
    super(props);
  }

  render() {
    if (this.props.estudante != null) {
      return (
        <div className="card bg-light">
          <div className="card-body">
            <div className="row">
              <div className="col-4">
                <img
                  width="100px"
                  height="100px"
                  className="alineadoTextoImagenCentro"
                  src={
                    "http://192.168.10.150/storage/" +
                    this.props.estudante.pathImage
                  }
                />
              </div>
              <div className="col-8">
                <p>
                  Curso:{" "}
                  <Mostrar_curso curso_id={this.props.estudante.curso_id} />{" "}
                </p>
                <p>
                  Turma:{" "}
                  <Mostrar_turma turma_id={this.props.estudante.turma_id} />{" "}
                  <span>Ano Académico: {this.props.anoAcademico}</span>
                </p>
              </div>
            </div>
            <div className="row">
              <div className="col-12">
                {" "}
                <p>{this.props.estudante.nome}</p>
              </div>
            </div>
          </div>
        </div>
      );
    } else {
      return null;
    }
  }
}

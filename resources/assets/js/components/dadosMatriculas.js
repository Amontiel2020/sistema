import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import Mostrar_curso from "./Mostrar_curso";
import Mostrar_turma from "./Mostrar_turma";

import "./estilos.css";

//const [id,task,completed]=useState({todo});
export default class getMatriculas extends Component {
  constructor(props) {
    super(props);
  }

  render() {
    if (this.props.estudante != null) {
      return (
        <table>
          <tr>
            <th></th>
            <th>Ano Curricular</th>
            <th>Semestre</th>
            <th>Ano académico</th>
          </tr>
        </table>
      );
    } else {
      return null;
    }
  }
}

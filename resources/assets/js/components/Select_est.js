import React, { Component, useState } from "react";
import axios from "axios";


export default class Select_est extends Component {
  constructor(props) {
    super(props);
    this.state = { estudantes:[]};

    this.getEstudante = this.getEstudante.bind(this);
  }
   // get all estudantes from backend
   getEstudantes() {
    axios.get(`http://192.168.10.150/api/estudantes_react`).then((res) => {
      const estudantes = res.data;
     // console.log(estudantes);
      this.setState({ estudantes: estudantes });
    });
  }
  getEstudante(e){
   // alert(e.target.value);
    const {getEstudante}=this.props;
    getEstudante(e.target.value);
  }
  componentWillMount(){
    this.getEstudantes();
   
  }
  render() {
    return (
      <div className="card">
        <div className="card-body">
                <select  className="form-control" onChange={this.getEstudante} >
            {this.state.estudantes.map((estudante) => (
              <option value={estudante.id} key={estudante.id} >
                {estudante.nome}
              </option>
            ))}
          </select>
        </div>
      </div>
    );
  }
}

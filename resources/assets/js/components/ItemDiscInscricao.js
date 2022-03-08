import React, { Component } from "react";
import ReactDOM from "react-dom";
import Option_estudante from "./Option_estudante";
import Modal from "./Modal.js";
import "./estilos.css";
import { BsXCircle } from "react-icons/bs";
import GetMes from "./GetMes";

//const todos={todos};
export default class ItemDiscInscricao extends Component {
  constructor(props) {
    super(props);

    this.addDisciplina = this.addDisciplina.bind(this);
    //this.deleteDisciplina = this.deleteDisciplina.bind(this);



  }

  addDisciplina(e){
    const {addDisciplina}=this.props;
    const {deleteDisciplina}=this.props;
 
    if(e.target.checked){
      addDisciplina(e.target.id);
    }
    else{
      deleteDisciplina(e.target.id);
    }
   
  }


  render() {
    return (
      <tr key={this.props.id} data-id={this.props.id} >
        <td><input type="checkbox" id={this.props.id} onClick={this.addDisciplina} /></td>
        <td>{this.props.nome}</td>

      </tr>
    );
  }
}

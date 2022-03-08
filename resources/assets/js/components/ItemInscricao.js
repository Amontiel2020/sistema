import React, { Component } from "react";
import ReactDOM from "react-dom";
import Option_estudante from "./Option_estudante";
import Modal from "./Modal.js";
import "./estilos.css";
import { BsXCircle } from "react-icons/bs";
import GetMes from "./GetMes";
import Mostrar_curso from "./Mostrar_curso";

//const todos={todos};
export default class ItemInscricao extends Component {
  constructor(props) {
    super(props);
    this.state = {
      nome: " ",
      punit: 0,
      qtd: 0,
      taxa: 0,
      desc: 0,
      valor: 0
    };

    this.deleteItem = this.deleteItem.bind(this);
    this.handleOnMouseClick = this.handleOnMouseClick.bind(this);
    this.showModal = this.showModal.bind(this);
  }

  deleteItem(e) {
    e.stopPropagation();
    const { deleteItem } = this.props;
    //deleteItem(e.target.id);
    deleteItem(e.currentTarget.getAttribute("data-id"));
  
  }
  handleOnMouseClick(e) {
    alert("OK");
  }

  showModal(e) {
    const { showModal } = this.props;
    let id = e.currentTarget.getAttribute("data-id");
    showModal(id);
  }
  componentDidUpdate(newProps) {
    if (newProps != this.props) {
      this.setState({
        taxa: newProps.newTaxa,
        desconto: newProps.newDesconto
      });
    }
  }



  render() {
    return (
      <tr 
        key={this.props.id} data-id={this.props.id} 
        onClick={this.showModal}
        onMouseOver={this.changeBackground}
        onMouseLeave={this.changeBackground2}
        style={{ cursor: "pointer" }}
      >
        <td></td>
        <td>{this.props.anoAcademico}</td>
        <td>{this.props.data}</td>
        <td><Mostrar_curso curso_id={this.props.curso_id} /></td>
        <td>{this.props.anoCurricular}</td>
        <td>{this.props.semestre}</td>
        <td width="2%" className="botonDeleteItem">
          <BsXCircle
            className="BsXCircleDelete"
            onClick={this.deleteItem}
            data-id={this.props.id}
            color="red"
            size={15}
          />
        </td>

      </tr>
    );
  }
}

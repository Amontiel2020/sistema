import React, { Component } from "react";
import ReactDOM from "react-dom";
import Option_estudante from "./Option_estudante";
import Modal from "./Modal.js";
import "./estilos.css";
import { BsXCircle } from "react-icons/bs";
import GetMes from "./GetMes";

//const todos={todos};
export default class TableItem extends Component {
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
    this.getNome = this.getNome.bind(this);
  }

  deleteItem(e) {
    e.stopPropagation();
    const { deleteItem } = this.props;
    //deleteItem(e.target.id);
    deleteItem(e.currentTarget.getAttribute("data-id"));
    console.log(
      "index en table item ",
      e.currentTarget.getAttribute("data-id")
    );
  }
  handleOnMouseClick(e) {
    alert("OK");
  }

  getNome(nome) {
    // const {nome}=this.props;
    //console.log("Nome:", nome );
    switch (nome) {
      case "1":
        return "Propinas Outubro";
        break;
      case "2":
        return "Propinas Novembro";
        break;
      case "3":
        return "Propinas Dezembro";
        break;
      case "4":
        return "Propinas Janeiro";
        break;
      case "5":
        return "Propinas Fevereiro";
        break;
      case "6":
        return "Propinas Março";
        break;
      case "7":
        return "Propinas Abril";
        break;
      case "8":
        return "Propinas Maio";
        break;
      case "9":
        return "Propinas Junho ";
        break;
      case "10":
        return "Propinas Julho";
        break;

      default:
        return nome;
    }
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
        onClick={this.showModal}
        key={this.props.id}
        data-id={this.props.id}
        onMouseOver={this.changeBackground}
        onMouseLeave={this.changeBackground2}
        style={{ cursor: "pointer" }}
        className="linhaItem"
      >
        <td width="2%" className="botonDeleteItem">
          <BsXCircle
            className="BsXCircleDelete"
            onClick={this.deleteItem}
            data-id={this.props.id}
            color="red"
            size={15}
          />
        </td>
        <td className="item">
          {/*<span>{this.getNome(this.props.nome)}</span>{" "} */}
          <GetMes mes={this.props.nome} ano={this.props.ano} />
        </td>
        <td className="item">
          {new Intl.NumberFormat("pt-PT", {
            minimumFractionDigits: 2
          }).format(this.props.punit)}
        </td>
        <td className="item">
          {this.props.qtd}
        </td>
        <td className="item">
          {new Intl.NumberFormat("pt-PT", {
            minimumFractionDigits: 2
          }).format(this.props.taxa)}
        </td>
        <td className="item">
          {new Intl.NumberFormat("pt-PT", {
            minimumFractionDigits: 2
          }).format(this.props.desc)}
        </td>
        <td className="item">
          {this.props.obs}
        </td>
        <td className="item">
          {new Intl.NumberFormat("pt-PT", {
            minimumFractionDigits: 2
          }).format(this.props.valor)}
        </td>
      </tr>
    );
  }
}

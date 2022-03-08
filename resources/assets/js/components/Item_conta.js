import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import { BsFillTrashFill } from "react-icons/bs";

//const [id,task,completed]=useState({todo});
export default class Item_conta extends Component {
  constructor(props) {
    super(props);
    this.state = { estilo: "list-group-item-success" };

    this.changeBackground = this.changeBackground.bind(this);
    this.changeBackground2 = this.changeBackground2.bind(this);
    this.handleOnclick=this.handleOnclick.bind(this);
  }

  changeBackground(e) {
    e.preventDefault();
    // e.target.style.background = "red";
    this.setState({ estilo: "list-group-item-danger" });

  }
  changeBackground2(e) {
    e.preventDefault();
    this.setState({ estilo: "list-group-item-success" });
  }
  handleOnclick(){
    const { def_selection } = this.props;
    def_selection(this.props.estudante.id);
  }
  

  render() {
    return (
        <li
        className={"list-group-item "+this.state.estilo}
        key={this.props.estudante.id}
        onMouseOver={this.changeBackground}
        onMouseLeave={this.changeBackground2}
        onClick={this.handleOnclick}
      >
        <img
          className="rounded-circle alineadoTextoImagenCentro"
          src={
            "http://192.168.10.150/storage/" + this.props.estudante.pathImage
          }
        />
        <p className="small">{this.props.estudante.nome}</p>
      </li>
    );
  }
}

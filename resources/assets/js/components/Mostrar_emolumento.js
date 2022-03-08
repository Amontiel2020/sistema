import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import axios from "axios";

//const [id,task,completed]=useState({todo});
export default class Mostrar_emolumento extends Component {
  constructor(props) {
    super(props);
    this.state = { emolumento: {} };
    this.getEmolumento = this.getEmolumento.bind(this);

  }
  getEmolumento() {
    const emolumento_id = this.props.id;
    axios
      .get(`http://192.168.10.150/api/getEmolumento/${emolumento_id}`)
      .then((res) => {
        const em = res.data;
        // console.log(curso);
        this.setState({ emolumento: em });
      });
  }
  componentWillReceiveProps(newProps) {
     
    //console.log(this.props.curso_id);
  this.getEmolumento(newProps.id);

}

  render() {
    return <span>{this.state.emolumento.nome}</span>;
  }
}

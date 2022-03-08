import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import axios from "axios";


//const [id,task,completed]=useState({todo});
export default class Mostrar_turma extends Component {
  constructor(props) {
    super(props);
     this.state={ turma_id:0,turma: {} };
    this.getTurma = this.getTurma.bind(this);

  }
  getTurma(turma_id) {
    axios
      .get(`http://192.168.10.150/api/getTurma/${turma_id}`)
      .then((res) => {
        const turma = res.data;
        //console.log(curso);
        this.setState({ turma: turma });
      });
  }
  componentWillReceiveProps(newProps) {
     

   
      this.getTurma(newProps.turma_id);

     
 
}

componentDidMount(){
  this.getTurma(this.props.turma_id)
}

  render() {
    return (
       <span>{this.state.turma.identificador}</span>
      
    );
  }
}

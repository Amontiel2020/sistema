import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import axios from "axios";


//const [id,task,completed]=useState({todo});
export default class Mostrar_curso extends Component {
  constructor(props) {
    super(props);
     this.state={ curso_id:0,curso: {} };
    this.getCurso = this.getCurso.bind(this);

  }
  getCurso(curso_id) {
    axios
      .get(`http://192.168.10.150/api/getCurso/${curso_id}`)
      .then((res) => {
        const curso = res.data;
        //console.log(curso);
        this.setState({ curso: curso[0] });
      });
  }
  componentWillReceiveProps(newProps) {
     

    
      this.getCurso(newProps.curso_id);

     
 
}
componentDidMount(){
  this.getCurso(this.props.curso_id)
}




  render() {
    return (
      
       <span>{this.state.curso.nome}</span>
      
    );
  }
}

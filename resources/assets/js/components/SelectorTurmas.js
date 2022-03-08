import React, { Component } from "react";
import "./estilos.css";

class SelectorTurmas extends Component {
  constructor(props) {
    super(props);
    this.state = { turmas: [],cursos:[], selection: null };
  }
  getTurmas(selection) {
    if (selection != null) {
      axios
        .get(`http://192.168.10.150/api/getTurmas/${selection}`)
        .then((res) => {
          const turmas = res.data;
          this.setState({ turmas: turmas });
          //console.log(pagamentos);
        });
    } else {
      axios.get(`http://192.168.10.150/api/getTurmas`).then((res) => {
        const turmas = res.data;
        this.setState({ turmas: turmas });
        //console.log(pagamentos);
      });
    }
  }
  getCusos(){
    axios
    .get(`http://192.168.10.150/api/getCursos`)
    .then((res) => {
      const cursos = res.data;
      this.setState({ cursos: cursos });
      //console.log(pagamentos);
    });
  }
  componentDidMount() {
  this.getCusos();
  this.getTurmas(this.state.selection);
  }

  render() {
    return (
      <div id="selector_turma">
       
          {this.state.cursos.map((curso) => (
            <div className="curso" key={curso.id}>
              {curso.nome}
            </div>
          ))}
       
          {this.state.turmas.map((turma) => (
            <div className="turma" key={curso.id}>
              {turma.identificador}
            </div>
          ))}
      </div>
    );
  }
}

if (document.getElementById("selector_turmas")) {
    ReactDOM.render(
      <SelectorTurmas />,
      document.getElementById("selector_turmas")
    );
  }

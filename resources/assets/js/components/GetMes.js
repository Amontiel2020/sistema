import React, { Component, useState } from "react";

//const [id,task,completed]=useState({todo});
export default class GetMes extends Component {
  constructor(props) {
    super(props);

    this.state = {
      nome: ""
    };
    this.getNome = this.getNome.bind(this);
  }

  componentWillReceiveProps(newProps) {
    if (newProps != this.props) {
      this.getNome(newProps.mes, newProps.ano);
    }
  }
  componentDidMount() {
    this.getNome(this.props.mes, this.props.ano);
  }

  getNome(mes, ano) {
    if (ano == 2021) {
      switch (mes) {
        case 1:
          this.setState({ nome: "Out" });
          break;
          case "1":
            this.setState({ nome: "Propinas Outubro "+ano });
            break;
        case 2:
          this.setState({ nome: "Nov" });
          break;
          case "2":
            this.setState({ nome: "Propinas Novembro "+ano });
            break;
        case 3:
          this.setState({ nome: "Dez" });
          break;
          case "3":
            this.setState({ nome: "Propinas Dezembro "+ano });
            break;
        case 4:
          this.setState({ nome: "Jan" });
          break;
          case "4":
            this.setState({ nome: "Propinas Janeiro 2022 "});
            break;
        case 5:
          this.setState({ nome: "Fev" });
          break;
          case "5":
            this.setState({ nome: "Propinas Fevereiro 2022 "});
            break;
        case 6:
          this.setState({ nome: "Mar" });
          break;
          case "6":
            this.setState({ nome: "Propinas Março 2022 "});
            break;
        case 7:
          this.setState({ nome: "Abr" });
          break;
          case "7":
            this.setState({ nome: "Propinas Abril 2022 "});
            break;
        case 8:
          this.setState({ nome: "Mai" });
          break;
          case "8":
            this.setState({ nome: "Propinas Maio 2022 "});
            break;
        case 9:
          this.setState({ nome: "Jun" });
          break;
          case "9":
            this.setState({ nome: "Propinas Junho 2022 "});
            break;
        case 10:
          this.setState({ nome: "Jul" });
          break;
          case "10":
            this.setState({ nome: "Propinas Julho 2022 "});
            break;

        default:
          this.setState({ nome: mes });

          break;
      }
    }
    if (ano == 2020) {
      switch (mes) {
        case 1:
          this.setState({ nome: "Mar" });
          break;
        case "1":
          this.setState({ nome: "Propinas Março " + ano });
          break;
        case 2:
          this.setState({ nome: "Out" });
          break;
        case "2":
          this.setState({ nome: "Propinas Outubro " + ano });
          break;
        case 3:
          this.setState({ nome: "Nov" });
          break;
        case "3":
          this.setState({ nome: "Propinas Novembro " + ano });
          break;
        case 4:
          this.setState({ nome: "Dez" });
          break;
        case "4":
          this.setState({ nome: "Propinas Dezembro " + ano });
          break;
        case 5:
          this.setState({ nome: "Jan" });
          break;
        case "5":
          this.setState({ nome: "Propinas Janeiro 2021" });
          break;
        case 6:
          this.setState({ nome: "Fev" });
          break;
        case "6":
          this.setState({ nome: "Propinas Fevereiro 2021 " + ano });
          break;
        case 7:
          this.setState({ nome: "Mar" });
          break;
        case "7":
          this.setState({ nome: "Propinas Março 2021 " });
          break;
        case 8:
          this.setState({ nome: "Abr" });
          break;
        case "8":
          this.setState({ nome: "Propinas Abril 2021" });
          break;
        case 9:
          this.setState({ nome: "Mai" });
          break;
        case "9":
          this.setState({ nome: "Propinas Maio 2021" });
          break;
        case 10:
          this.setState({ nome: "Jun" });
          break;
        case "10":
          this.setState({ nome: "Propinas Junho 2021" });
          break;

        default:
          this.setState({ nome: mes });

          break;
      }
    }
    if (ano == 0) this.setState({ nome: mes });
  }

  render() {
    return <span>{this.state.nome}</span>;
  }
}

import React, { Component } from "react";
import TodoItem from "./TodoItem";
import axios from "axios";
import "bootstrap/dist/css/bootstrap.min.css";
import GetMes from "./GetMes";

//const todos={todos};
export default class PagamentosConta extends Component {
  constructor(props) {
    super(props);
    this.buscarPagamento = this.buscarPagamento.bind(this);
    this.pagamentoSeleccionado = this.pagamentoSeleccionado.bind(this);
  }

  buscarPagamento(mes, ano) {
    const result = this.props.pagamentos.find(
      (pagamento) => pagamento.mes == mes && pagamento.ano == ano
    );
    //return result != null ? true : false;
    if (result != null) {
      return result.valor;
    } else {
      return null;
    }
  }
  pagamentoSeleccionado(e) {
    const { pagamentoSeleccionado } = this.props;
   const ano= e.currentTarget.getAttribute("data-ano");

    pagamentoSeleccionado(e.target.value,ano);
  }
  componentDidMount() {
    // console.log(this.props.pagamentos);
  }

  render() {
    if (this.props.pagamentos.length != 0) {
      return (
        <div className="row">
         <div className="col-6 mt-2">
         {this.buscarPagamento(3, 2020) != null && (
            <div className="card card-pagamentos ms-3">
              <div className="card-header">
                {" "}
                <h5>2020/2021</h5>
              </div>
              <div className="card-body">
                <table className="table table-bordered table-striped table-pagamentos">
                  <tbody>
                    <tr>
                      <th>Mes</th>
                      <th>Pagamento</th>
                    </tr>
                    {[...Array(10)].map((x, i) => {
                      return (
                        <tr key={i}>
                          <td>
                            <button type="button" className="btn btn-light btn-sm position-relative">
                             <GetMes mes={i+1} ano={2020}/>
                              <span className="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info">
                                {i+1}
                              </span>
                            </button>
                          </td>
                          {this.buscarPagamento(i + 3, 2020) != null && (
                            <td>
                              {this.buscarPagamento(i + 3, 2020)}{" "}
                              <span className="badge rounded-pill bg-success">
                                Pago
                              </span>
                            </td>
                          )}
                          {this.buscarPagamento(i + 3, 2020) == null && (
                            <td className="text-center">
                              {" "}
                              <button
                                value={i + 1}
                                data-ano={2020}
                                className="btn btn-primary btn-sm"
                                onClick={this.pagamentoSeleccionado}
                              >
                                Pagar
                              </button>
                            </td>
                          )}
                        </tr>
                      );
                    })}
                  </tbody>
                </table>
              </div>
            </div>

         )}

          </div>
          <div className="col-6 mt-2">
            <div className="card card-pagamentos me-3">
              <div className="card-header">
                {" "}
                <h5>2021/2022</h5>
              </div>
              <div className="card-body">
                <table className="table table-bordered table-striped table-pagamentos">
                  <tbody>
                    <tr>
                      <th>Mes</th>
                      <th>Pagamento</th>
                    </tr>
                    {[...Array(10)].map((x, i) => {
                      return (
                        <tr key={i}>
                          <td>
                            <button type="button" className="btn btn-light btn-sm position-relative">
                             <GetMes mes={i+1} ano={2021}/>
                              <span className="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info">
                                {i+1}
                              </span>
                            </button>
                          </td>
                          {this.buscarPagamento(i + 1, 2021) != null && (
                            <td>
                              {this.buscarPagamento(i + 1, 2021)}{" "}
                              <span className="badge rounded-pill bg-success">
                                Pago
                              </span>
                            </td>
                          )}
                          {this.buscarPagamento(i + 1, 2021) == null && (
                            <td className="text-center">
                              {" "}
                              <button
                                value={i + 1}
                                data-ano={2021}
                                className="btn btn-primary btn-sm"
                                onClick={this.pagamentoSeleccionado}
                              >
                                Pagar
                              </button>
                            </td>
                          )}
                        </tr>
                      );
                    })}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      );
    } else {
      return null;
    }
  }
}

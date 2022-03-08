import React from "react";
import Pdf from "react-to-pdf";
import TableItem from "./TableItem";
import GetMes from "./GetMes";
import Mostrar_curso from "./Mostrar_curso";
import Mostrar_turma from "./Mostrar_turma";
import "bootstrap/dist/css/bootstrap.min.css";
import "./factura.css";
import moment from "moment";

const ref = React.createRef();

const PDF = ({ props, itens, estudante }) => {
  const total = itens.reduce(
    (total, currentValue) => (total = total + currentValue.valor),
    0
  );
  return (
    <div>
      <Pdf targetRef={ref} filename="post.pdf">
        {({ toPdf }) => <button onClick={toPdf}>Gerar PDF</button>}
      </Pdf>
     
      <div className="pdf" ref={ref}>
        <div className="container">
          <div className="row">
            <div className="col-12" align="center">
              <img
                width="50px"
                height="50px"
                src="http://192.168.10.150/storage/logo.png"
              />

              <p>
                <b>ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA</b>
              </p>
              <p> Decreto Presidencial nº 168/12 de 24 de Julho</p>
              <p>Recibo de pagamentos</p>
            </div>
          </div>

          <div className="row">
            <div className="col-12">
              <p>
                <b>Nome do Estudante:</b>&nbsp; &nbsp;{estudante.nome}{" "}
                &nbsp;&nbsp;&nbsp;<b>Nº do BI:</b> &nbsp;
                {estudante.BI}&nbsp;&nbsp;&nbsp;<b>Nº de Estudante:</b> &nbsp;
                {estudante.codigo}
              </p>
              <p>
                <b>Curso:</b>
                &nbsp;
                <Mostrar_curso curso_id={estudante.curso_id} />
                &nbsp;&nbsp;<b>Turma:</b>&nbsp;
                <Mostrar_turma turma_id={estudante.turma_id} />
                &nbsp;&nbsp;<b>Ano Acadêmico:</b>&nbsp;{"2021/2022"}
              </p>

              <p align="right">
                <b>Data:</b>&nbsp;{moment().format("DD-MM-YYYY")}
              </p>
            </div>
          </div>

          <div className="row">
            <table className="table_test">
            <thead>
              <tr>
                <th>Descrição</th>
                <th>P.Unit</th>
                <th>Qtd</th>
                <th>Taxa</th>
                <th>Desconto</th>
                <th>Forma de Pago</th>
                <th>Total</th>
              </tr>
              </thead>
              <tbody>
                {itens.map((item, i) => (
                  <tr key={i}>
                    <td className="item">
                      {/*<span>{this.getNome(this.props.nome)}</span>{" "} */}
                      <GetMes mes={item.nome} ano={item.ano} />
                    </td>
                    <td className="item">
                      {new Intl.NumberFormat("pt-PT", {
                        minimumFractionDigits: 2
                      }).format(item.punit)}
                    </td>
                    <td className="item">{item.qtd}</td>
                    <td className="item">
                      {new Intl.NumberFormat("pt-PT", {
                        minimumFractionDigits: 2
                      }).format(item.taxa)}
                    </td>
                    <td className="item">
                      {new Intl.NumberFormat("pt-PT", {
                        minimumFractionDigits: 2
                      }).format(item.desc)}
                    </td>
                    <td className="item">{item.obs}</td>
                    <td className="item">
                      {new Intl.NumberFormat("pt-PT", {
                        minimumFractionDigits: 2
                      }).format(item.valor)}
                    </td>
                  </tr>
                ))}
                <tr>
                  <td align="right" colSpan="8" style={{ fontSize: "15px" }}>
                    <span>
                      Total:{" "}
                      {new Intl.NumberFormat("pt-PT", {
                        minimumFractionDigits: 2
                      }).format(total)}{" "}
                      {"Kz"}
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <br />
          <div className="row">
            <div className="col-6">
              <p>
                <b>Assinatura do estudante</b>
                ______________________________________
              </p>
            </div>
            <div className="col-6">
              <p>
                <b>Nome do funcionário</b>
                __________________________________________
              </p>
            </div>
          </div>

          <br />
          <p align="center">
            Telef. +244 996616277/921226215 - Email: espbenguela@gmail.com
            Bairro da Graça - Benguela Angola
          </p>
          <p className="linia">
            ------------------------------------------------------------------------------------------------------
            --------------------------------------------------------------------------------------------------------------------------
          </p>
        </div>

        <div className="container">
          <div className="row">
            <div className="col-12" align="center">
              <img
                width="50px"
                height="50px"
                src="http://192.168.10.150/storage/logo.png"
              />

              <p>
                <b>ESCOLA SUPERIOR POLITÉCNICA DE BENGUELA</b>
              </p>
              <p> Decreto Presidencial nº 168/12 de 24 de Julho</p>
              <p>Recibo de pagamentos</p>
            </div>
          </div>

          <div className="row">
            <div className="col-12">
              <p>
                <b>Nome do Estudante:</b>&nbsp; &nbsp;{estudante.nome}{" "}
                &nbsp;&nbsp;&nbsp;<b>Nº do BI:</b> &nbsp;
                {estudante.BI}&nbsp;&nbsp;&nbsp;<b>Nº de Estudante:</b> &nbsp;
                {estudante.codigo}
              </p>
              <p>
                <b>Curso:</b>
                &nbsp;
                <Mostrar_curso curso_id={estudante.curso_id} />
                &nbsp;&nbsp;<b>Turma:</b> &nbsp;
                <Mostrar_turma turma_id={estudante.turma_id} />
                &nbsp;&nbsp;<b>Ano Acadêmico:</b>&nbsp;{"2021/2022"}
              </p>

              <p align="right">
                <b>Data:</b>&nbsp;{moment().format("DD-MM-YYYY")}
              </p>
            </div>
          </div>

          <div className="row">
            <table className="table_test">
            <thead>
              <tr>
                <th>Descrição</th>
                <th>P.Unit</th>
                <th>Qtd</th>
                <th>Taxa</th>
                <th>Desconto</th>
                <th>Forma de Pago</th>
                <th>Total</th>
              </tr>
              </thead>
              <tbody>
                {itens.map((item, y) => (
                  <tr key={y}>
                    <td className="item">
                      {/*<span>{this.getNome(this.props.nome)}</span>{" "} */}
                      <GetMes mes={item.nome} ano={item.ano} />
                    </td>
                    <td className="item">
                      {new Intl.NumberFormat("pt-PT", {
                        minimumFractionDigits: 2
                      }).format(item.punit)}
                    </td>
                    <td className="item">{item.qtd}</td>
                    <td className="item">
                      {new Intl.NumberFormat("pt-PT", {
                        minimumFractionDigits: 2
                      }).format(item.taxa)}
                    </td>
                    <td className="item">
                      {new Intl.NumberFormat("pt-PT", {
                        minimumFractionDigits: 2
                      }).format(item.desc)}
                    </td>
                    <td className="item">{item.obs}</td>
                    <td className="item">
                      {new Intl.NumberFormat("pt-PT", {
                        minimumFractionDigits: 2
                      }).format(item.valor)}
                    </td>
                  </tr>
                ))}
                <tr>
                  <td align="right" colSpan="8" style={{ fontSize: "15px" }}>
                    <span>
                      Total:{" "}
                      {new Intl.NumberFormat("pt-PT", {
                        minimumFractionDigits: 2
                      }).format(total)}{" "}
                      {"Kz"}
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <br />
          <div className="row">
            <div className="col-6">
              <p>
                <b>Assinatura do estudante</b>
                ______________________________________
              </p>
            </div>
            <div className="col-6">
              <p>
                <b>Nome do funcionário</b>
                __________________________________________
              </p>
            </div>
          </div>

          <br />
          <p align="center">
            Telef. +244 996616277/921226215 - Email: espbenguela@gmail.com
            Bairro da Graça - Benguela Angola
          </p>
        </div>
      </div>
    </div>
  );
};

export default PDF;

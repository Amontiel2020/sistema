import React, { Component, useState, Suspense, lazy } from "react";
import ReactDOM from "react-dom";
import TodoList from "./TodoList";
import Select_estudantes from "./Select_estudantes";
import Select_cursos from "./Select_cursos";
import DadosConta from "./DadosConta";
import PagamentosSemFazer from "./PagamentosSemFazer";

import Detalhes from "./Detalhes";
import Temporal from "./Temporal";
import Contas from "./Contas";

import "bootstrap/dist/css/bootstrap.min.css";
import axios from "axios";
import Select_anoAcademico from "./Select_anoAcademico";
import Otros_pagamentos from "./Otros_pagamentos";


//const DadosConta = lazy(() => import("./DadosConta"));
//const PagamentosSemFazer = lazy(() => import("./DaPagamentosSemFazerdosConta"));

//const [todos,setTodos]=useState([{id:1,task:"Tarea",completed:false}]);
export default class Index extends Component {
  constructor(props) {
    super(props);
    this.state = {
      todos: [],
      outros_pagamentos: [],
      text: "",
      estudantes: [],
      turmas: [],
      cursos: [],
      selection: 0,
      curso_marcado: 0,
      turma_marcada: 0,
      pagamento_marcado: {},
      estudante_seleccionado: {},
      pagamentosSemFazer: [],
      pagamentosTemp: [],
      colunas: 10,
      anoAcademico: "2022",
    };

    this.handleChange = this.handleChange.bind(this);
    this.handleSeleccionado = this.handleSeleccionado.bind(this);
    this.def_selection = this.def_selection.bind(this);

    this.handleCursoMarcado = this.handleCursoMarcado.bind(this);
    this.handleTurmaMarcada = this.handleTurmaMarcada.bind(this);
    this.handlePagamentoMarcadoIndex = this.handlePagamentoMarcadoIndex.bind(
      this
    );
    this.handleSubmit = this.handleSubmit.bind(this);
    this.getPagamentos = this.getPagamentos.bind(this);
    this.getPagamentosTemp = this.getPagamentosTemp.bind(this);
    this.handleSelectMesChange = this.handleSelectMesChange.bind(this);
    this.handleSelectTaxaChange = this.handleSelectTaxaChange.bind(this);
    this.handleMes_propinaClick = this.handleMes_propinaClick.bind(this);
    this.handlePagamentoTemp = this.handlePagamentoTemp.bind(this);
    this.pagamentoTempSelecionado = this.pagamentoTempSelecionado.bind(this);
    this.gerarComprovativo = this.gerarComprovativo.bind(this);
    this.actualizar = this.actualizar.bind(this);
    this.handleUpdatePagamentoTemp = this.handleUpdatePagamentoTemp.bind(this);
    this.handleAnoAcademico = this.handleAnoAcademico.bind(this);
    this.getOutros_pagamentos = this.getOutros_pagamentos.bind(this);


    //this.handleColunas = this.handleColunas.bind(this);
  }
  handleChange(e) {
    this.setState({ text: e.target.value });
  }
  handleSeleccionado(selection) {
    const anoAcademico=this.state.anoAcademico;
    this.setState({ selection: selection });
    this.getPagamentos(selection,anoAcademico);
    this.getOutros_pagamentos(selection,anoAcademico);
    this.getEstudante(selection);
    this.getPagamentosSemFazer(selection,anoAcademico);
    this.getPagamentosTemp(selection);

    //this.getEstudante(selection);
  }
  handleAnoAcademico(ano) {
   // const selection = this.state.selection;
    this.setState({ anoAcademico: ano });
    this.getPagamentos(this.state.selection,ano);
    this.getOutros_pagamentos(this.state.selection,ano);
    this.getPagamentosSemFazer(this.state.selection,ano);
    this.getPagamentosTemp(this.state.selection);
  }
  def_selection(selection) {
    const anoAcademico=this.state.anoAcademico;
    this.setState({ selection: selection });
    this.getPagamentos(selection,anoAcademico);
    this.getOutros_pagamentos(selection,anoAcademico);
    this.getEstudante(selection);
    this.getPagamentosSemFazer(selection,anoAcademico);
    this.getPagamentosTemp(selection);

    //this.getEstudante(selection);
  }
  handlePagamentoTemp(p) {
    const pagamento = p;

    var bodyFormData = new FormData();
    bodyFormData.set("estudante_id", pagamento.estudante_id);
    bodyFormData.set("mes", pagamento.mes);
    bodyFormData.set("taxa", pagamento.taxa);

    axios
      .post(`http://192.168.10.150/api/save_pagamentoTemp`, bodyFormData)
      .then((res) => {
        this.getPagamentosTemp(this.state.selection);
      });
  }
  pagamentoTempSelecionado(id) {
    axios
      .get(`http://192.168.10.150/api/eliminarPagamentoTemp/${id}`)
      .then((res) => {
        this.getPagamentosTemp(this.state.selection);
      });
  }
  handleUpdatePagamentoTemp(bodyFormData) {
    // test=bodyFormData.get("id")
    // console.log(test);
    const id = bodyFormData.get("id");
    const taxa = bodyFormData.get("taxa");

    axios
      .get(`http://192.168.10.150/api/updatePagamentoTemp/${id}/${taxa}`)
      .then((res) => {
        this.getPagamentosTemp(this.state.selection);
      });
  }
  handleCursoMarcado(selection) {
    //console.log(selection);
    this.setState({ curso_marcado: selection });
    this.filtrarTurmas(selection);
  }
  handleTurmaMarcada(selection) {
    //console.log(selection);
    this.setState({ turma_marcada: selection });
    this.filtrarEstudantes(selection);
  }

  // get all tasks from backend
  getEstudantes() {
    axios.get(`http://192.168.10.150/api/estudantes_react`).then((res) => {
      const estudantes = res.data;
      this.setState({ estudantes: estudantes });
    });
  }

  getTurmas() {
    axios.get(`http://192.168.10.150/api/getTurmas`).then((res) => {
      const turmas = res.data;
      this.setState({ turmas: turmas });
    });
  }
  filtrarTurmas(selection) {
    axios
      .get(`http://192.168.10.150/api/filtrarTurmas/${selection}`)
      .then((res) => {
        const turmas = res.data;
        this.setState({ turmas: turmas });
      });
  }
  filtrarEstudantes(selection) {
    axios
      .get(`http://192.168.10.150/api/filtrarEstudantes/${selection}`)
      .then((res) => {
        const estudantes = res.data;
        this.setState({ estudantes: estudantes });
      });
  }

  getCursos() {
    axios.get(`http://192.168.10.150/api/getCursos`).then((res) => {
      const cursos = res.data;
      this.setState({ cursos: cursos });
    });
  }

  getPagamentos(selection,anoAcademico) {
    //const anoAcademico = this.state.anoAcademico;
    // console.log(anoAcademico);
    axios
      .get(
        `http://192.168.10.150/api/pagamentos_react/${selection}/${anoAcademico}`
      )
      .then((res) => {
        const pagamentos = res.data;
        this.setState({ todos: pagamentos });
      });
  }
  getOutros_pagamentos(selection,anoAcademico) {
   
   // const anoAcademico = this.state.anoAcademico;
    // console.log(anoAcademico);
    axios
      .get(
        `http://192.168.10.150/api/outrosPagamentos/${selection}/${anoAcademico}`
      )
      .then((res) => {
        const pagamentos = res.data;
        this.setState({ outros_pagamentos: pagamentos });
      });
  }
  getPagamentosSemFazer(selection,anoAcademico) {
    //const anoAcademico = this.state.anoAcademico;

    axios
      .get(
        `http://192.168.10.150/api/getPagamentosSemFazer/${selection}/${anoAcademico}`
      )
      .then((res) => {
        const pagamentos = res.data;
        //console.log(pagamentos);
        this.setState({ pagamentosSemFazer: pagamentos });
      });
  }
  getEstudante(selection) {
    axios
      .get(`http://192.168.10.150/api/getEstudante/${selection}`)
      .then((res) => {
        const estudante = res.data;
        //console.log(estudante);
        this.setState({ estudante_seleccionado: estudante[0] });
      });
  }

  getPagamentosTemp(estudante_id) {
    axios
      .get(`http://192.168.10.150/api/getJsonPagamentosTemp2/${estudante_id}`)
      .then((res) => {
        const pagamentos = res.data;
        // console.log(pagamentos);
        if (pagamentos != "") {
          this.setState({ colunas: 8 });
        } else if (pagamentos == "" && this.state.pagamento_marcado == "") {
          this.setState({ colunas: 10 });
        }
        this.setState({ pagamentosTemp: pagamentos });
      });
  }

  handleSelectMesChange(e) {
    this.setState({ mes: e.target.value });
  }
  handleSelectTaxaChange(e) {
    this.setState({ taxa: e.target.value });
  }

  handlePagamentoMarcadoIndex(selection, value) {
    if (value) {
      this.getPagamento_marcado(selection);
    }
    if (!value) {
      this.setState({ pagamento_marcado: "" });
      if (this.state.pagamentosTemp == "") {
        this.setState({ colunas: 10 });
      }
    }
  }
  getPagamento_marcado(selection) {
    // const {selection} =  this.state;

    axios
      .get(`http://192.168.10.150/api/getPagamento/${selection}`)
      .then((res) => {
        const pagamento = res.data;
        this.setState({ pagamento_marcado: pagamento[0] });
        this.setState({ colunas: 8 });
      });
  }

  handleSubmit(e) {
    e.preventDefault();
    const anoAcademico=this.state.anoAcademico;
    var bodyFormData = new FormData();
    bodyFormData.set("estudante_id", this.state.selection);
    bodyFormData.set("mes", this.state.mes);
    bodyFormData.set("taxa", this.state.taxa);

    axios
      .post(`http://192.168.10.150/api/save_pagamento`, bodyFormData)
      .then((res) => {
        this.getPagamentos(this.state.selection,anoAcademico);
      });
  }
  handleMes_propinaClick() {
    alert("Ok");
  }

  // lifecycle method
  componentWillMount() {
    this.getEstudantes();
    this.getTurmas();
    this.getCursos();
    this.getPagamentosTemp(this.state.selection);

    // this.getPagamentos(this.state.selection);
  }
  gerarComprovativo() {
    axios.get(`http://192.168.10.150/api/gerarComprovativo`).then((res) => {
      // this.getPagamentos(this.state.selection);
    });
  }
  actualizar() {
    this.getPagamentosTemp(this.state.selection);
    this.getPagamentos(this.state.selection,this.state.anoAcademico);
    this.getPagamentosSemFazer(this.state.selection,this.state.anoAcademico);
    // alert("Actualizado");
  }

  render() {
    //const meses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    return (
      <div className="container-fluid">
        <div className="row">
          <div className="col-2">
            <Contas
              turmas={this.state.turmas}
              cursos={this.state.cursos}
              estudantes={this.state.estudantes}
              handleCursoMarcado={this.handleCursoMarcado}
              handleTurmaMarcada={this.handleTurmaMarcada}
              def_selection={this.def_selection}
            />
          </div>
          <div className={"col-" + this.state.colunas}>
            <div className="card">
              <div className="card-header">
                <h3 className="card-title">Subsistema pagamentos propinas</h3>
              </div>
              <div className="card-body">
                <div className="card">
                  <div className="card-body">
                    <div className="row">
                      <div className="col-md-8">
                        <Select_estudantes
                          estudantes={this.state.estudantes}
                          handleSeleccionado={this.handleSeleccionado}
                        />
                      </div>
                      <div className="col-md-4">
                        <Select_anoAcademico
                          anoAcademico={this.handleAnoAcademico}
                        />
                      </div>
                    </div>

                    <DadosConta estudante={this.state.estudante_seleccionado} anoAcademico={this.state.anoAcademico} />

                    <PagamentosSemFazer
                      pagamentos={this.state.pagamentosSemFazer}
                      handlePagamentoTemp={this.handlePagamentoTemp}
                    />
                  </div>
                </div>
                <TodoList
                  handlePagamentoMarcadoIndex={this.handlePagamentoMarcadoIndex}
                  todos={this.state.todos}
                />
              </div>
              <Otros_pagamentos
                  pagamentos={this.state.outros_pagamentos}
                />
            </div>
          </div>
          <div className="col-2">
            <Detalhes pagamento_marcado={this.state.pagamento_marcado} />

            <Temporal
              pagamentosTemp={this.state.pagamentosTemp}
              pagamentoTempSelecionado={this.pagamentoTempSelecionado}
              selection={this.state.selection}
              actualizar={this.actualizar}
              handleUpdatePagamentoTemp={this.handleUpdatePagamentoTemp}
            />
          </div>
        </div>
      </div>
    );
  }
}

if (document.getElementById("example")) {
  ReactDOM.render(<Index />, document.getElementById("example"));
}

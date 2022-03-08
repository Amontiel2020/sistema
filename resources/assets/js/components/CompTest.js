import React, { Component } from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import Select_est from "./Select_est";
import html2canvas from "html2canvas";
import jsPDF from "jspdf";

import "./estilos.css";
import "bootstrap/dist/css/bootstrap.min.css";

import DefinicoesDocument from "./definicoesDocument";
import Select_emol from "./Select_emol";
import TableItens from "./TableItens";
import DadosConta from "./DadosConta";
import PagamentosConta from "./PagamentosConta";
import Modal from "./Modal.js";
import ModalDelete from "./ModalDelete.js";
import ModalConfirmFactura from "./ModalConfirmFactura.js";

import GetMes from "./GetMes.js";

import { BsPlusCircle } from "react-icons/bs";
import { BsDashCircle } from "react-icons/bs";
import Factura from "./PDF";

export default class CompTest extends Component {
  constructor(props) {
    super(props);
    this.state = {
      contador: 1,
      itens: [],
      itemSel: null,
      pagamentos: [],
      estudanteSel: null,
      emolumento: null,
      show: false,
      showDelete: false,
      taxaTemp: 0,
      indexDelete: null,
      imprimirFactura: false,
      showConfirmFactura:false,
      total:0
    };

    this.decrementar = this.decrementar.bind(this);
    this.aumentar = this.aumentar.bind(this);
    this.seleccionado = this.seleccionado.bind(this);
    this.setItens = this.setItens.bind(this);
    this.deleteItem = this.deleteItem.bind(this);
    this.getEmolumento = this.getEmolumento.bind(this);
    this.getEstudante = this.getEstudante.bind(this);
    this.getPagamentos = this.getPagamentos.bind(this);
    this.pagamentoSeleccionado = this.pagamentoSeleccionado.bind(this);
    this.showModal = this.showModal.bind(this);
    this.hideModal = this.hideModal.bind(this);
    this.showModalDelete = this.showModalDelete.bind(this);
    this.hideModalDelete = this.hideModalDelete.bind(this);
    this.showModalConfirmFactura = this.showModalConfirmFactura.bind(this);
    this.hideModalConfirmFactura = this.hideModalConfirmFactura.bind(this);
    this.confirmFactura = this.confirmFactura.bind(this);

    

    this.onChangeTaxa = this.onChangeTaxa.bind(this);
    this.actualizarTotal = this.actualizarTotal.bind(this);
    this.confirmDelete = this.confirmDelete.bind(this);
    this.printDocument = this.printDocument.bind(this);
    this.savePagamentos=this.savePagamentos.bind(this);
    this.onChangeFormaPago=this.onChangeFormaPago.bind(this);
    this.onChangeDescrip=this.onChangeDescrip.bind(this);

    

   

  }



  decrementar() {
    this.setState({
      contador: this.state.contador - 1
    });
  }
  aumentar() {
    this.setState({
      contador: this.state.contador + 1
    });
  }
  seleccionado(id) {
    // alert(id);
    axios.get(`http://192.168.10.150/api/emolumento/${id}`).then((res) => {
      const emolumento = res.data;
      //console.log(emolumento);
      this.setState({ emolumento: emolumento });
      const itensCopy = Array.from(this.state.itens);
      itensCopy.push({
        id: this.state.emolumento.id,
        nome: this.state.emolumento.nome,
        punit: this.state.emolumento.valor,
        qtd: this.state.contador,
        taxa: 0,
        desc: 0,
        valor: this.state.emolumento.valor * this.state.contador,
        ano: 0,
        emolumento_id:this.state.emolumento.id,
        obs:"TPA",
        mes:0,
        descrip:""
      });
      this.setItens(itensCopy);
    });
  }
  pagamentoSeleccionado(mes, ano) {
    const itensCopy = Array.from(this.state.itens);
    itensCopy.push({
      id: "Mes" + mes,
      nome: mes,
      ano: ano,
      punit: 25000,
      qtd: 1,
      taxa: 0,
      desc: 0,
      valor: 25000,
      emolumento_id:1,
      mes:mes,
      obs:"TPA",
      descrip:""
    });
    this.setItens(itensCopy);
  }
  setItens(itens) {
    this.setState({ itens: itens });
    
  }

  deleteItem(index) {
   
    this.showModalDelete();
    this.setState({ indexDelete: index });
  }

  confirmDelete() {
   
    var i = this.state.itens.findIndex((x) => x.id == this.state.indexDelete);
    var listaItens = [...this.state.itens];
       listaItens.splice(i, 1);
    this.setItens(listaItens);
    this.setState({ indexDelete: null });
    this.hideModalDelete();
  }

  inserirEmolumento() {
    alert("OK");
  }

  getEmolumento(id) {
    axios.get(`http://192.168.10.150/api/emolumento/${id}`).then((res) => {
      const emolumento = res.data;
      //console.log(emolumento);
      this.setState({ emolumento: emolumento });
    });
  }
  getEstudante(selection) {
    // alert(selection)
    axios
      .get(`http://192.168.10.150/api/getEstudante/${selection}`)
      .then((res) => {
        const estudante = res.data;
        //console.log(estudante);
        this.setState({ estudanteSel: estudante });
        this.getPagamentos(this.state.estudanteSel.id);
      });
  }

  getPagamentos(selection) {
    //console.log("Paramentros",selection,anoAcademico);
    axios
      .get(`http://192.168.10.150/api/pagamentos_react/${selection}`)
      .then((res) => {
        const pagamentos = res.data;
        this.setState({ pagamentos: pagamentos });
        //console.log(pagamentos);
      });
  }
  savePagamentos() {
   /* const headers = { 
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
  };*/
  const bodyFormData = new FormData();
  bodyFormData.append("estudante_id",this.state.estudanteSel.id);
  //bodyFormData.append("itens",this.state.itens);

    this.state.itens.map((item, i) => {
      bodyFormData.append('valor',item.valor);
      bodyFormData.append('punit',item.punit);
      bodyFormData.append('taxa',item.taxa);
      bodyFormData.append('emolumento_id',item.emolumento_id);
      bodyFormData.append('mes',item.mes);
      bodyFormData.append('obs',item.obs);
      bodyFormData.append('descrip',item.descrip);


      

      axios
      .post('http://192.168.10.150/save_pagamento',bodyFormData)
      .then((res) => {
           this.printDocument();
      })

    })
  }
    
    
  
  showModal(id) {
    this.setState({ show: true });
    const result = this.state.itens.find((item) => item.id == id);
    this.setState({ itemSel: result });
    this.setState({ taxaTemp: result.taxa });
  }
  hideModal() {
    this.setState({ show: false });
    this.actualizarTotal(this.state.taxaTemp);
  }
  showModalDelete(index) {
    this.setState({ showDelete: true });
    this.setState({ indexDelete: index });
  }
  hideModalDelete() {
    this.setState({ showDelete: false });
  }

  showModalConfirmFactura() {
    this.setState({ showConfirmFactura: true });
   
  }
  hideModalConfirmFactura() {
    this.setState({ showConfirmFactura: false });
  }
  confirmFactura(){
   
    this.hideModalConfirmFactura();
    this.savePagamentos();
   

  }

  onChangeTaxa(e) {
    const taxaDig = e.target.value;
    const item = this.state.itemSel;
    item.taxa = taxaDig;
    //item.valor=parseInt(item.valor)+parseInt(taxaDig);
    /*this.setState({itemSel:{    
     ...this.state.itemSel,
      taxa:taxaDig   
   }})*/
    this.setState({ itemSel: item });
  }
  onChangeFormaPago(e) {
    const obs = e.target.value;
    const item = this.state.itemSel;
    item.obs = obs;
    this.setState({ itemSel: item });
  }
  onChangeDescrip(e) {
    const descrip = e.target.value;
    const item = this.state.itemSel;
    item.descrip = descrip;
    this.setState({ itemSel: item });
  }

  actualizarTotal(prevTaxa) {
    const item = this.state.itemSel;
    const taxa = item.taxa;
    if (prevTaxa !== taxa) {
      const valorSemTaxa = parseInt(item.valor) - parseInt(prevTaxa);
      const novaTaxa = parseInt(valorSemTaxa) + parseInt(taxa);
      item.valor = novaTaxa;
      this.setState({ itemSel: item });
    }
    this.setState({ taxaTemp: 0 });
  }

  printDocument() {
    this.setState({ imprimirFactura: true });
  }


  render() {
    return (
      <div>
        {!this.state.imprimirFactura ? (
          <main className="grid">
            <div className="head">
              <h3 className="text-center">Selecione o Estudante</h3>
              <Select_est getEstudante={this.getEstudante} />
            </div>
            <div id="documentPdf" className="main">
              <TableItens
                itens={this.state.itens}
                deleteItem={this.deleteItem}
                showModal={this.showModal}
                showModalConfirmFactura={this.showModalConfirmFactura}
                total={this.state.total}
                imprimir={this.printDocument}
              />
            </div>
            <div className="side">
              <DadosConta estudante={this.state.estudanteSel} />
              <PagamentosConta
                pagamentos={this.state.pagamentos}
                pagamentoSeleccionado={this.pagamentoSeleccionado}
              />
            </div>
            <div className="footer">
              <div className="row">
                <div className="col-2">
                  <div className="row">
                    <div className="col-4">
                      <BsDashCircle
                        onClick={this.decrementar}
                        color="green"
                        size={20}
                      />
                    </div>
                    <div className="col-4"><span style={{fontSize:"18px"}}>{this.state.contador}</span></div>
                    <div className="col-4">
                      <BsPlusCircle
                        onClick={this.aumentar}
                        color="green"
                        size={20}
                      />
                    </div>
                  </div>
                </div>
                <div className="col-10">
                  <Select_emol seleccionado={this.seleccionado} />
                </div>
              </div>
            </div>

            <Modal
              show={this.state.show}
              handleClose={this.hideModal}
              itemSel={this.state.itemSel}
              onChangeTaxa={this.onChangeTaxa}
              onChangeFormaPago={this.onChangeFormaPago}
              onChangeDescrip={this.onChangeDescrip}


            />
            <ModalDelete
              show={this.state.showDelete}
              handleClose={this.hideModalDelete}
              confirmDelete={this.confirmDelete}
            />
            <ModalConfirmFactura
              show={this.state.showConfirmFactura}
              handleClose={this.hideModalConfirmFactura}
              confirmFactura={this.confirmFactura}
            />
          </main>
        ) : (
          <Factura 
          itens={this.state.itens} 
          estudante={this.state.estudanteSel} />
        )}
      </div>
    );
  }
}

if (document.getElementById("pagamentosResidencias")) {
  ReactDOM.render(
    <CompTest />,
    document.getElementById("pagamentosResidencias")
  );
}

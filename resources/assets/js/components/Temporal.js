import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import html2canvas from "html2canvas";
import jsPDF from "jspdf";
import Item_pagamentoTemp from "./Item_pagamentoTemp";

//const [id,task,completed]=useState({todo});
export default class Temporal extends Component {
  constructor(props) {
    super(props);
    // this.setState({ todo: this.props.todo });
    this.handledOnClick=this.handledOnClick.bind(this);
    this.printDocument = this.printDocument.bind(this);
    this.handleUpdatePagamentoTemp = this.handleUpdatePagamentoTemp.bind(this);
    


  }

  handledOnClick(id){
   // alert("OK");
    const {pagamentoTempSelecionado}=this.props;
    pagamentoTempSelecionado(id);
  }
  
  handleUpdatePagamentoTemp(bodyFormData){
   // alert("OK");
     const {handleUpdatePagamentoTemp}=this.props;
     handleUpdatePagamentoTemp(bodyFormData);
   }
  printDocument() {
    const {id} = this.props.selection;
    const {actualizar}=this.props;
   

    axios.get(`http://192.168.10.150/api/save_pagamento/${id}`).then((res) => {
     // this.getPagamentosTemp(this.state.selection);
    //  this.getPagamentos(this.state.selection);
    //  this.getPagamentosSemFazer(this.state.selection);
    actualizar();
      const input = document.getElementById("divToPrint");

      html2canvas(input).then((canvas) => {
        var wid = 0;
        var hgt = 0;

        const imgData = canvas.toDataURL(
          "image/png",
          (wid = canvas.width),
          (hgt = canvas.height)
        );
        var hratio = hgt / wid;
        const pdf = new jsPDF("p", "pt", "a4");
        var width = pdf.internal.pageSize.width;
        var height = width * hratio;
        pdf.addImage(imgData, "JPEG", 20, 20, width, height);
        // pdf.output('dataurlnewwindow');
        pdf.save("download.pdf");
      });
    });
  }

  render() {
    if(this.props.pagamentosTemp!=""){
      return (
        <div className="card">
          <div id="test" className="card-body">
            <h5 className="card-title">Pagamentos Temp</h5>
            <ul className="list-group">
              {this.props.pagamentosTemp.map((pagamento,index) => (
                  <Item_pagamentoTemp key={pagamento.id}  pagamento={pagamento} handledOnClick={this.handledOnClick} handleUpdatePagamentoTemp={this.handleUpdatePagamentoTemp}/>
              ))}
            </ul>
           
          </div>
          <div className="card-footer">
          <button className="btn btn-primary btn-sm btn-block" onClick={this.printDocument}>Imprimir</button>
          </div>
        </div>
      );
    }else{
      return null;
    }

   
  }
}

import React from "react";
import "./modal.css";
import TableDisciplinasInscricao from "./TableDisciplinasInscricao";

const Modal = ({ handleClose, show, children, inscricaoSel,disciplinas,disciplinasParaInscricao, onChangeTaxa
  ,onChangeFormaPago,onChangeDescrip,getDiscInscricao }) => {
  const showHideClassName = show ? "modal display-block" : "modal display-none";

  return (
    <div className={showHideClassName}>
      <section className="modal-main">
        {inscricaoSel != null && (
          <div className="card bg-light">
            <div className="card-body">
              <div className="row">

                 <TableDisciplinasInscricao 
                     disciplinas={disciplinas}
                     disciplinasParaInscricao={disciplinasParaInscricao}
                     inscricaoSel={inscricaoSel}
                     getDiscInscricao={getDiscInscricao}
                   
                     
                 />              
                 </div>
            </div>
          </div>
        )}

        <button
          className="btn btn-primary btn-sm"
          type="button"
          onClick={handleClose}
        >
          Fechar
        </button>
      </section>
    </div>
  );
};
export default Modal;

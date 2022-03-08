import React from "react";
import "./modalDelete.css";
import "bootstrap/dist/css/bootstrap.min.css";
import { BsQuestionCircle } from "react-icons/bs";

const Modal = ({ handleClose, show,confirmFactura }) => {
  const showHideClassName = show ? "modal display-block" : "modal display-none";

  return (
    <div className={showHideClassName}>
      <section className="modal-main">
        <div className="text-center">
          <BsQuestionCircle size={80} />
        </div>
        <h1 className="text-center"> Emitir Factura?</h1>

        <div className="row text-center">
        <div className="col-2"></div>
          <div className="col-4">
            <button
              className="btn btn-danger btn-sm"
              type="button"
              onClick={confirmFactura}
            >
             Emitir
            </button>
          </div>
          <div className="col-2">
            <button
              className="btn btn-primary btn-sm"
              type="button"
              onClick={handleClose}
            >
              Cancelar
            </button>
          </div>
        <div className="col-4"></div>

        </div>
      </section>
    </div>
  );
};
export default Modal;

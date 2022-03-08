import React from "react";
import "./modalDelete.css";
import "bootstrap/dist/css/bootstrap.min.css";
import { BsExclamationCircle } from "react-icons/bs";

const Modal = ({ handleClose, show,confirmDelete }) => {
  const showHideClassName = show ? "modal display-block" : "modal display-none";

  return (
    <div className={showHideClassName}>
      <section className="modal-main">
        <div className="text-center">
          <BsExclamationCircle size={80} />
        </div>
        <h1 className="text-center">Remover o Item?</h1>

        <div className="row text-center">
        <div className="col-2"></div>
          <div className="col-4">
            <button
              className="btn btn-danger btn-sm"
              type="button"
              onClick={confirmDelete}
            >
              Sim, remover o Item
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

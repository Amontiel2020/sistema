import React from "react";
import "./modal.css";

const Modal = ({ handleClose, show, children, itemSel, onChangeTaxa,onChangeFormaPago,onChangeDescrip }) => {
  const showHideClassName = show ? "modal display-block" : "modal display-none";

  return (
    <div className={showHideClassName}>
      <section className="modal-main">
        {itemSel != null && (
          <div className="card bg-light">
            <div className="card-body">
              <div className="row">
                <div className="col-6">
                  <div className="form-group">
                    <label>Nome</label>
                    <input
                      disabled
                      type="text"
                      className="form-control"
                      name="nome"
                      value={itemSel.nome || ""}
                    />
                  </div>
                  <div className="form-group">
                    <label>Preço Unitario</label>
                    <input
                      type="text"
                      className="form-control"
                      name="punit"
                      value={itemSel.punit || ""}
                      disabled
                    />
                  </div>
                  <div className="form-group">
                    <label>Quantidade</label>
                    <input
                      type="text"
                      className="form-control"
                      name="qtd"
                      value={itemSel.qtd || ""}
                      disabled
                    />
                  </div>
                  <div className="form-group">
                    <label>Observação</label>
                    <textarea
                      type="text"
                      className="form-control"
                      name="descrip"
                      value={itemSel.descrip || ""}
                      rows="3"
                      onChange={onChangeDescrip}
                    />
                    
                  </div>
                </div>
                <div className="col-6">
                  <div className="form-group">
                    <label>Taxa</label>
                    <select
                      className="form-control"
                      onChange={onChangeTaxa}
                      value={itemSel.taxa || ""}
                    >
                      <option value="1250">1250</option>
                      <option value="2500">2500</option>
                      <option value="3750">3750</option>
                      <option value="5000">5000</option>
                    </select>
                    {/*   <input
                      type="text"
                      className="form-control"
                      name="taxa"
                      value={itemSel.taxa || ""}
                      onChange={onChangeTaxa}
                    />
                   */}
                  </div>
                  <div className="form-group">
                    <label>Desconto</label>
                    <input
                      type="text"
                      className="form-control"
                      name="desc"
                      value={itemSel.desc || ""}
                      disabled
                    />
                  </div>
                  <div className="form-group">
                    <label>Valor</label>
                    <input
                      type="text"
                      className="form-control"
                      name="valor"
                      value={itemSel.valor || ""}
                    />
                  </div>
                  <div className="form-group">
                    <label>Forma Pagamento</label>
                    <select
                      className="form-control"
                      onChange={onChangeFormaPago}
                      value={itemSel.obs || ""}
                    >
                      <option value="TPA">TPA</option>
                      <option value="Transferência">Transferência</option>
                      <option value="Dinheiro">Dinheiro</option>
                      
                    </select>
                  </div>
                </div>
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

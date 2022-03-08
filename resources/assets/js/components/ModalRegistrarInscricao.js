import React,{useState} from "react";
import "./modal.css";


const Modal = ({ handleClose,handleSave, show,estudanteSel }) => {
  const showHideClassName = show ? "modal display-block" : "modal display-none";
  const [anoCurricular, setAnoCurricular] = useState(null);
  const [sem, setSem] = useState(null);
  const [anoAcad, setAnoAcad] = useState(null);




  return (
    <div className={showHideClassName}>
      <section className="modal-main">
        <div className="card bg-light">
          <div className="card-body">
            <div className="row">
           
              <div className="col-md-4">
                <div className="form-group">
                  <label>Ano Curricular</label>
                  <select className="form-control" onChange={(e) => setAnoCurricular(e.target.value)}>
                    <option value="1º">1º</option>
                    <option value="2º">2º</option>
                    <option value="3º">3º</option>
                    <option value="4º">4º</option>
                    <option value="5º">5º</option>
                  </select>
                </div>
              </div>
              <div className="col-md-4">
                <div className="form-group">
                  <label>Semestre</label>
                  <select className="form-control" onChange={(e) => setSem(e.target.value)}>
                    <option value="I">I</option>
                    <option value="II">II</option>
                  </select>
                </div>
              </div>
              <div className="col-md-4">
                <div className="form-group">
                  <label>Ano Académico</label>
                  <select className="form-control" onChange={(e) => setAnoAcad(e.target.value)}>
                    <option value="2021">2020/2021</option>
                    <option value="2022">2021/2022</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

        <button
          className="btn btn-primary btn-sm"
          type="button"
          onClick={handleClose}
        >
          Fechar
        </button>
        <button
          className="btn btn-primary btn-sm"
          type="button"
          value={estudanteSel}
          onClick={() => handleSave(estudanteSel,anoCurricular,sem,anoAcad)}
          
        >
          Salvar
        </button>
      </section>
    </div>
  );
};
export default Modal;

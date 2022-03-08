import React, { Component, useState } from "react";
import ReactDOM from "react-dom";




//const todos={todos};
export default class Select_anoAcademico extends Component {
  constructor(props) {
    super(props);
  
    this.handleSelectAnoChange = this.handleSelectAnoChange.bind(this);
  }

  handleSelectAnoChange(e) {
    const {anoAcademico}=this.props;
    anoAcademico(e.target.value);

  }
  render() {
    return (
      <div className="card">
        <div className="card-body">
                <select onChange={this.handleSelectAnoChange} className="form-control">
                <option value="2020" key="2019/2020">2019/2020</option>
               <option value="2021" key="2020/2021">2020/2021</option>
               <option value="2022" key="2021/2022">2021/2022</option>
            </select>
        </div>
      </div>
    );
  }
}

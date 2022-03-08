import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import Option_estudante from "./Option_estudante";



//const todos={todos};
export default class Select_emolumentos extends Component {
  constructor(props) {
    super(props);
  //  this.state = { selection: 0 };
  //  this.handleSelectChange = this.handleSelectChange.bind(this);
  //  this.handleClick = this.handleClick.bind(this);
  }
  
  render() {
    return (
      <div className="card">
        <div className="card-body">
                <select  className="form-control">
            {this.props.emolumentos.map((emolumento) => (
              <option value={emolumento.id} key={emolumento.id}>
                {emolumento.nome}
              </option>
            ))}
          </select>
        </div>
      </div>
    );
  }
}

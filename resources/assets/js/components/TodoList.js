import React, { Component, useState } from "react";
import ReactDOM from "react-dom";
import TodoItem from "./TodoItem";

//const todos={todos};
export default class TodoList extends Component {
  constructor(props) {
    super(props);
    // this.setState({  pagamento_marcado:{} });
    this.handlePagamentoMarcado = this.handlePagamentoMarcado.bind(this);
  }

  handlePagamentoMarcado(selection,value) {
    // this.setState({ pagamento_marcado: selection });
    // alert(selection);
    const { handlePagamentoMarcadoIndex } = this.props;
    handlePagamentoMarcadoIndex(selection,value);
  }
  render() {
    if (this.props.todos != "") {
    return (
      <div id="divToPrint" className="card">
        <div className="card-body">
          <div className="row">
            {this.props.todos.map((todo) => (
              <TodoItem
                handlePagamentoMarcado={this.handlePagamentoMarcado}
                key={todo.id}
                todo={todo}
              />
            ))}
          </div>
        </div>
      </div>
    );
    }
    else{
      return null;
    }
  }
}

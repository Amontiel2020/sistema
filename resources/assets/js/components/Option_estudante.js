import React, { Component,useState } from 'react';
import ReactDOM from 'react-dom';
import { PropTypes } from 'prop-types';


export default class Option_estudante extends Component {
    constructor(props) {
        super(props);
      
      }
      
    render() {
        const {handleClick}=this.props;
        return (
           <option value={this.props.estudante.id} onClick={handleClick}>
               {this.props.estudante.nome} 
           </option>
        );
    }

}
Option_estudante.proptypes={
    handleClick:PropTypes.func.isRequired
}
import React, { Component } from 'react'
import Select from 'react-select'
import axios from 'axios'

export default class Async_select extends Component {

  constructor(props){
    super(props)
    this.state = {
      selectOptions : [],
      id: "",
      name: ''
    }
  }

 async getOptions(){
    const res = await axios.get('http://192.168.10.150/api/estudantes_react')
    const data = res.data

    const options = data.map(d => ({
      "value" : d.id,
      "label" :<div><img src={'/storage/'+d.pathImage}/></div>

    }))

    this.setState({selectOptions: options})

  }

  handleChange(e){
   this.setState({id:e.value, name:e.label})
  }

  componentDidMount(){
      this.getOptions()
  }

  render() {
   
    return (
      <div>
        <Select options={this.state.selectOptions} onChange={this.handleChange.bind(this)} />
    <p>You have selected <strong>{this.state.name}</strong> whose id is <strong>{this.state.id}</strong></p>
      </div>
    )
  }
}
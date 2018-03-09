import { Component, Prop } from '@stencil/core';

@Component({
  tag: 'techomaha-input',
  styleUrl: 'input.scss'
})



export class Input {
  @Prop() type: string;
  @Prop() name: string;
  @Prop() placeholder: string;
  @Prop() value: string;



  render(){
		if ( this.type === "textarea" ){
			return ( <textarea name={this.name} placeholder={this.placeholder}> {this.value} </textarea>)
		} else {
			return ( <input type={this.type} name={this.name} placeholder={this.placeholder} value={this.value}/>)
		}
	}
}
 



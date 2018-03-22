import { Component, State } from '@stencil/core';
import 'smart-image-wc';
import 'ionicons';

@Component({
  tag: 'techomaha-select',
  styleUrl: 'select.scss'
})

export class Select {
  @Prop() options: string[];
  @State() value: string;
  @State() selectValue: string;

  handleSelect(event) {
    console.log(event.target.value);
    this.selectValue = event.target.value;
  }

  handleChange(event) {
    this.value = event.target.value;

    if (event.target.validity.typeMismatch) {
      console.log('this element is not valid')
    }
  }

  render() {
    return (
      <select value={this.selectValue} onInput={(event) => this.handleSelect(event)}>
      {this.options.map((option) =>
        <option value={option} selected={option === this.selectValue}>{option}</option>
      )}
      </select>
    )
  }
}

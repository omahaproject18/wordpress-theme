import { Component, State, Prop, Element, Listen } from '@stencil/core';

@Component({
  tag: 'techomaha-select',
  styleUrl: 'select.scss'
})

export class Select {
  @Element() element: HTMLElement;
  @Prop() name: string = "select[]";
  @Prop() value: string;
  @Prop() placeholder: string = "Select an option...";


  @State() selectedValue: string;
  @State() open: boolean = false;

  @Listen("selected")
  handleSelect(event) {
    this.selectedValue = event.target.value;
    this.toggleOptions();
  }

  componentWillLoad() {
    this.selectedValue = this.value;
  }

  // Adding onBlur event will not trigger the selected event
  toggleOptions() {
    this.open = !this.open;
  }

  render() {
    return (
      <div class={"select open-" + this.open} onInput={ (event) => this.handleSelect(event) }>
        <input name={this.name}
               placeholder={this.placeholder}
               value={this.selectedValue}
               onFocus={ () => this.toggleOptions() }
               />
        <div class="options">
          <slot></slot>
        </div>
      </div>
    )
  }
}

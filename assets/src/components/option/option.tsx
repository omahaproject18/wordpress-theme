import { Component, Prop, Event, EventEmitter } from '@stencil/core';

@Component({
  tag: 'techomaha-option',
  styleUrl: 'option.scss'
})

export class Option {
  @Prop() value: any;
  @Event() selected: EventEmitter;

  selectedHandler(value: string) {
    this.selected.emit(value);
  }

  render() {
    return (
      <button onClick={() => { this.selectedHandler(this.value); }} >{ this.value }</button>
    )
  }
}

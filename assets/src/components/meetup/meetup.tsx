import { Component, State } from '@stencil/core';

@Component({
  tag: 'techomaha-meetup',
  styleUrl: 'meetup.scss'
})

export class Meetup {
  @State() column: "4-column";
  @State() padding: 0;

  render() {
    return [
      <techomaha-grid column={this.column} padding={this.padding}></techomaha-grid>
    ];
  }
}
import { Component, State } from '@stencil/core';

@Component({
  tag: 'techomaha-about',
  styleUrl: 'about.scss'
})

export class About {
  @State() column: "2-column";
  @State() padding: 0;

  render() {
    return [
      <techomaha-grid column={this.column} padding={this.padding}></techomaha-grid>,
      <techomaha-meetup></techomaha-meetup>
    ];
  }
}

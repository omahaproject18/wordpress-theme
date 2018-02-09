import { Component } from '@stencil/core';

@Component({
  tag: 'techomaha-button',
  styleUrl: 'button.scss'
})

export class Button {
  render() {
  	return <slot />
  }
}

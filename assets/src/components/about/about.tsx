import { Component } from '@stencil/core';

@Component({
  tag: 'techomaha-about',
  styleUrl: 'about.scss'
})

export class About {
  render() {
  	return <slot />
  }
}

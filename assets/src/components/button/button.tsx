import { Component, Prop} from '@stencil/core';

@Component({
  tag: 'techomaha-button',
  styleUrl: 'button.scss'
})

export class Button {
  @Prop() type: string = "button";
  @Prop() href: string = "https://stenciljs.com/";
  @Prop() value: string;
  @Prop() emoji: string;//need to find emoji type

  render() {

    console.log(this.type);
    if(this.type == "link")
    {
      return <a href={this.href}><slot /></a>
    }
  	return <slot />
  }
}

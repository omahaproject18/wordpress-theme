import { Component, Prop } from '@stencil/core';
import 'smart-image-wc';
import 'ionicons';

@Component({
  tag: 'techomaha-toggle',
  styleUrl: 'toggle.scss'
})

export class Toggle {
  @Prop() type: string; // (radio||checkbox)
  @Prop() label: string;

  render() {
    if(this.type === 'radio') {
      return <div><label><input type="radio" />{this.label}</label></div>
    } else if(this.type === 'checkbox') {
      return <div><label><input type="checkbox" />{this.label}</label></div>
    } else {
      return <div>Property "type" must be set to "radio" or "checkbox"</div>
    }
  }
}

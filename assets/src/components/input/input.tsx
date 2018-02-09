import { Component, Prop } from '@stencil/core';

@Component({
  tag: 'techomaha-input',
  styleUrl: 'input.scss'
})



export class Input {
  @Prop() type: string;



  render() {
  	return (

        <input type={this.type}/>

    );
  }
}


// THis is the html I want to render
// <input  type="email">


// import { Component, Prop } from '@stencil/core';

// @Component({
//   tag: 'my-first-component',
//   styleUrl: 'my-first-component.scss'
// })
// export class MyComponent {

//   // Indicate that name should be a public property on the component
//   @Prop() name: string;

//   render() {
//     return (
//       <p>
//         My name is {this.name}
//       </p>
//     );
//   }
// }
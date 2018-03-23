import { Component, Prop } from '@stencil/core';

@Component({
  tag: 'techomaha-grid',
  styleUrl: 'grid.scss'
})

export class Grid {
    @Prop() padding: 0;
    @Prop() column: 0;

    render() {
        return <slot />
    }
}

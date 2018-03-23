import { Component, Prop } from '@stencil/core';

@Component({
  tag: 'techomaha-grid',
  styleUrl: 'grid.scss'
})

export class Grid {
    @Prop() padding: number;
    @Prop() column: string;

    render() {
        return <slot />
    }
}

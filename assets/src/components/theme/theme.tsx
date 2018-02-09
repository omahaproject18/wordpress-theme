import { Component } from '@stencil/core';

@Component({
    tag: 'techomaha-theme',
    styleUrl: 'theme.scss'
})

export class Theme {
    render() {
        return <div class="container">
            <slot />
        </div>
    }
}

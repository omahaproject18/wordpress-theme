import { Component } from '@stencil/core';
import 'smart-image-wc';
import 'ionicons';

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

import { Component } from '@stencil/core';

@Component({
    tag: 'techomaha-navigation',
    styleUrl: 'navigation.scss'
})
export class Navigation {
    pages = [
        'About',
        'Videos',
        'Project 18',
        'Calendar'
    ]

    handleSelect(item, event) {
        console.log(`clicked ${item} (${event.target})`)
    }

    render() {
        return <div class="container">
            <a class="logo" href="https://techomaha.org/">
                <img alt="Tech Omaha logo" src="images/tech-omaha-logo.png" />
            </a>
            {this.pages.map(page =>
            <button class="page" onClick={this.handleSelect.bind(this, page)}>
                {page}
            </button>
            )}
        </div>
    }
}

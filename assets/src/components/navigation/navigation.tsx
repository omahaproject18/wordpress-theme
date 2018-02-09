import { Component } from '@stencil/core';

@Component({
    tag: 'techomaha-navigation',
    styleUrl: 'navigation.scss'
})

export class Navigation {
    items = [
        'Home',
        'About',
        'Videos',
        'Project 18',
        'Calendar'
    ]

    handleSelect(item) {
        console.log(`clicked ${item}`)
    }

    render() {
        return <div>
            {this.items.map(item => <button onClick={this.handleSelect.bind(item)}>{item}</button>)}
        </div>
    }
}

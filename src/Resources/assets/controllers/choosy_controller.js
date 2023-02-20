import {Controller} from "@hotwired/stimulus"
import Choosy from "@michael-brauner/choosy";

export default class extends Controller {

    static targets = []

    static values = {
        options: Object
    }

    choosy

    connect() {

        console.log('hey')
        this.choosy = this.element.querySelector('select')

        if (this.choosy.__x) {
            this.choosy.__x.clear()
            this.choosy.__x = undefined
        }

        new Choosy(
            this.choosy,
            this.hasOptionsValue ? this.optionsValue : undefined
        )
    }
}
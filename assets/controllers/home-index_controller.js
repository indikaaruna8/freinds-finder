import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        //    this.element.textContent = 'wHello Stimulus! Edit me in assets/controllers/hello_controller.js';
        this.loadData();
    }

    loadData() {
        $.ajax({
            accepts: {
                mycustomtype: 'application/x-some-custom-type'
            },
            url: "/admin/data",
            context: document.body
        }).done(function () {
            $(this).addClass("done");
        });
    }

}

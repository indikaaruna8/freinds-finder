import { Controller } from '@hotwired/stimulus';
import dt from 'datatables.net';
import admin from '../module/admin';
//require('../wag');
//require('../network');
export default class extends Controller {
    connect() {
        //    this.element.textContent = 'wHello Stimulus! Edit me in assets/controllers/hello_controller.js';
        this.loadData();
    }

    loadData() {
        $('#admintable').DataTable({
            paging: true
        });
    }
}

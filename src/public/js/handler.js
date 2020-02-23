'use strict';

const form = document.forms.namedItem('form');
const button = document.getElementById('send-data');

let request = new XMLHttpRequest();
let formData = new FormData(form);

let res = document.getElementById('response');
let load = document.getElementById('load');

class Handler {

    constructor() {}

    onRequest(event) {
        event.preventDefault();

        formData.append(form.title.name, form.title.value);
        formData.append(form.description.name, form.description.value);
        formData.append(form.image.name, form.image.files[0]);

        request.open('post', '/add', true);

        request.upload.addEventListener('progress', function (event) {
            if (!event.lengthComputable) {
                return;
            }

            let percentComplete = event.loaded / event.total * 100;

            load.innerHTML = `
                <div class="progress">
                    <div class="determinate" style="width: ${percentComplete}%"></div>
                </div>`;
        }, false);

        request.send(formData);

        request.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200) {
                switch (+request.responseText) {
                    case 201:
                        res.innerHTML = 'exito total';
                        break;
                    case 431:
                        res.innerHTML = 'archivo muy grande';
                        break;
                    case 400:
                        res.innerHTML = 'formato no permitido';
                        break;
                    case 500:
                        res.innerHTML = 'error en el servidor';
                        break;
                }
            }
        };
    }
}

window.addEventListener('load', () => {
    button.addEventListener('click', new Handler().onRequest);
});
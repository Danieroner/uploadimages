'use strict';

const form = document.forms.namedItem('form');
const button = document.getElementById('send-data');

let request = new XMLHttpRequest();
let formData = new FormData(form);

let res = document.getElementById('response');
let load = document.getElementById('load');

class Handler {

    constructor() {}

    onRequest() {

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

            if (percentComplete === 100) {
                load.innerHTML = '';
            }

        }, false);

        request.send(formData);

        request.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200) {
                res.innerHTML = request.responseText;
                switch (+request.responseText) {
                    case 201:
                        res.innerHTML = `<div class="card-panel light-blue darken-1"><span class="white-text text-darken-2"><h5>The image was successfully uploaded</h5></span></div>`;
                        setTimeout(() => location.href = '/', 700);
                        break;
                    case 431:
                        res.innerHTML = `<div class="card-panel yellow lighten-1"><span class="black-text text-darken-2"><h5>The image cannot exceed 5 mb</h5></span></div>`;
                        break;
                    case 401:
                        res.innerHTML = `<div class="card-panel yellow lighten-1"><span class="black-text text-darken-2"><h5>This format is not allowed, only .jpg .png .gif</h5></span></div>`;
                        break;
                    case 500:
                        res.innerHTML = `<div class="card-panel deep-orange accent-4"><span class="white-text text-darken-2"><h5>Internal Error</h5></span></div>`;
                        break;
                }
            }
        };
    }
}

window.addEventListener('load', () => {
    button.addEventListener('click', (event) => {
        event.preventDefault();

        if (form.title.value == ''              ||
            form.title.value.lenght === 0       ||
            /^\s+$/.test(form.title.value)      ||
            form.description.value === ''       ||
            form.description.value.lenght === 0 ||
            /^\s+$/.test(form.description.value)||
            form.image.files[0] === undefined)    
        {
            res.innerHTML = `<div class="card-panel deep-orange accent-4"><span class="white-text text-darken-2"><h5>Empty data
            </h5></span></div>`;
        } else {
            new Handler().onRequest();
        }

    });
});
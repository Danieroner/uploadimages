'use strict';

const form = document.forms.namedItem('form');
let formData = new FormData(form);


const button = document.getElementById('send-data');
let res = document.getElementById('response');
let load = document.getElementById('load');

const xhr = new XMLHttpRequest();

const openRequest = function (event) {
    event.preventDefault();
    
    formData.append(form.title.name, form.title.value);
    formData.append(form.description.name, form.description.value);
    formData.append(form.image.name, form.image.files[0]);
    console.log(form.image.files[0]);

    xhr.open('POST', '/add', true);
    xhr.upload.addEventListener('progress', function (event) {
        if (event.lengthComputable) {
            let percentComplete = event.loaded / event.total * 100;

            load.innerHTML = `
            <div class="progress">
                <div class="determinate" style="width: ${percentComplete}%"></div>
            </div>
            `;

            console.log(percentComplete);
        }
    }, false);
    xhr.send(formData);

    xhr.onreadystatechange = function () {
        if(this.readyState == 4 && this.status == 200) {
            res.innerHTML = xhr.responseText;
        }
    };
    
}

button.addEventListener('click', openRequest);
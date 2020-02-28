import { button, form, response, formData, request, load } from './elements';
import { ResponseAjax, CreateSuccessfully, CreateExceed, CreateNotAllowed, CreateInternalError } from './response';


function run(response: ResponseAjax) {
    response.someOperation();
}

function makeRun(event: MouseEvent) {
    event.preventDefault();

    const rex: RegExp = new RegExp(/^\s*$/);
    
    if (rex.test(form.title.value) || 
        rex.test(form.description.value) ||
        form.image.files[0] === undefined) {
        response.innerHTML = `
            <div class="card-panel deep-orange accent-4">
                <span class="white-text text-darken-2">
                    <h5>Empty data</h5>
                </span>
            </div>`;
        return;
    }

    formData.append(form.title.name, form.title.value);
    formData.append(form.description.name, form.description.value);
    formData.append(form.image.name, form.image.files[0]);

    request.open('post', '/add', true);

    request.upload.addEventListener('progress', (ev: ProgressEvent<XMLHttpRequestEventTarget>) => {
        if (!ev.lengthComputable) {
            return;
        }

        let percentComplete: number = ev.loaded / ev.total * 100;

        load.innerHTML = `
            <div class="progress">
                <div class="determinate" style="width: ${percentComplete}%">
                </div>
            </div>`;
        
        if (percentComplete === 100) {
            load.innerHTML = '';
        }
    }, false);

    request.send(formData);

    request.onreadystatechange = function (this: XMLHttpRequest, ev: Event) {
        if (this.readyState == 4 && this.status == 200) {

            response.innerHTML = request.responseText;

            switch (+request.responseText) {
                case 201:
                    run(new CreateSuccessfully());
                    break;
                case 431:
                    run(new CreateExceed());
                    break;
                case 401:
                    run(new CreateNotAllowed());
                case 500:
                    run(new CreateInternalError());
                    break;
            }
        }
    }
}

function windowLoad() {
    button.addEventListener('click', makeRun);
}

window.addEventListener('load', windowLoad);
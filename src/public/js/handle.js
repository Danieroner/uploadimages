define(["require", "exports", "./elements", "./response"], function (require, exports, elements_1, response_1) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    function run(response) {
        response.someOperation();
    }
    function makeRun(event) {
        event.preventDefault();
        var rex = new RegExp(/^\s*$/);
        if (rex.test(elements_1.form.title.value) ||
            rex.test(elements_1.form.description.value) ||
            elements_1.form.image.files[0] === undefined) {
            elements_1.response.innerHTML = "\n            <div class=\"card-panel deep-orange accent-4\">\n                <span class=\"white-text text-darken-2\">\n                    <h5>Empty data</h5>\n                </span>\n            </div>";
            return;
        }
        elements_1.formData.append(elements_1.form.title.name, elements_1.form.title.value);
        elements_1.formData.append(elements_1.form.description.name, elements_1.form.description.value);
        elements_1.formData.append(elements_1.form.image.name, elements_1.form.image.files[0]);
        elements_1.request.open('post', '/add', true);
        elements_1.request.upload.addEventListener('progress', function (ev) {
            if (!ev.lengthComputable) {
                return;
            }
            var percentComplete = ev.loaded / ev.total * 100;
            elements_1.load.innerHTML = "\n            <div class=\"progress\">\n                <div class=\"determinate\" style=\"width: " + percentComplete + "%\">\n                </div>\n            </div>";
            if (percentComplete === 100) {
                elements_1.load.innerHTML = '';
            }
        }, false);
        elements_1.request.send(elements_1.formData);
        elements_1.request.onreadystatechange = function (ev) {
            if (this.readyState == 4 && this.status == 200) {
                elements_1.response.innerHTML = elements_1.request.responseText;
                switch (+elements_1.request.responseText) {
                    case 201:
                        run(new response_1.CreateSuccessfully());
                        break;
                    case 431:
                        run(new response_1.CreateExceed());
                        break;
                    case 401:
                        run(new response_1.CreateNotAllowed());
                    case 500:
                        run(new response_1.CreateInternalError());
                        break;
                }
            }
        };
    }
    function windowLoad() {
        elements_1.button.addEventListener('click', makeRun);
    }
    window.addEventListener('load', windowLoad);
});
//# sourceMappingURL=handle.js.map
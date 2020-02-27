"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const elements_1 = require("./elements");
class Successfully {
    render() {
        elements_1.response.innerHTML = `
            <div class="card-panel light-blue darken-1">
                <span class="white-text text-darken-2">
                    <h5>The image was successfully uploaded</h5>
                </span>
            </div>`;
        setTimeout(() => location.href = '/', 700);
    }
}
exports.Successfully = Successfully;
class Exceed {
    render() {
        elements_1.response.innerHTML = `
            <div class="card-panel yellow lighten-1">
                <span class="black-text text-darken-2">
                    <h5>The image cannot exceed 5 mb</h5>
                </span>
            </div>`;
    }
}
exports.Exceed = Exceed;
class NotAllowed {
    render() {
        elements_1.response.innerHTML = `
            <div class="card-panel yellow lighten-1">
                <span class="black-text text-darken-2">
                    <h5>This format is not allowed, only .jpg .png .gif</h5>
                </span>
            </div>`;
    }
}
exports.NotAllowed = NotAllowed;
class InternalError {
    render() {
        elements_1.response.innerHTML =
            `<div class="card-panel deep-orange accent-4">
                <span class="white-text text-darken-2">
                    <h5>Internal Error</h5>
                </span>
            </div>`;
    }
}
exports.InternalError = InternalError;
//# sourceMappingURL=button.js.map
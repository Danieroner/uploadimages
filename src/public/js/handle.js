"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const elements_1 = require("./elements");
function run(response) {
    response.someOperation();
}
function makeRun() {
    console.log('functiona!!!');
}
function windowLoad() {
    elements_1.button.addEventListener('click', makeRun);
}
window.addEventListener('load', windowLoad);
//# sourceMappingURL=handle.js.map
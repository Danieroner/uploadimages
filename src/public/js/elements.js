"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.form = document.forms.namedItem('form');
exports.button = document.getElementById('send-data');
exports.request = new XMLHttpRequest();
exports.formData = new FormData(exports.form);
exports.response = document.getElementById('response');
exports.load = document.getElementById('load');
//# sourceMappingURL=elements.js.map
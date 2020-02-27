"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const button_1 = require("./button");
class ResponseAjax {
    someOperation() {
        const product = this.getResponse();
    }
}
exports.default = ResponseAjax;
class CreateSuccessfully extends ResponseAjax {
    getResponse() {
        return new button_1.Successfully();
    }
}
class CreateExceed extends ResponseAjax {
    getResponse() {
        return new button_1.Exceed();
    }
}
class CreateNotAllowed extends ResponseAjax {
    getResponse() {
        return new button_1.NotAllowed();
    }
}
class CreateInternalError extends ResponseAjax {
    getResponse() {
        return new button_1.InternalError();
    }
}
//# sourceMappingURL=response.js.map
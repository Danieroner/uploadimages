var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
define(["require", "exports", "./button"], function (require, exports, button_1) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    var ResponseAJAX = /** @class */ (function () {
        function ResponseAJAX() {
        }
        ResponseAJAX.prototype.someOperation = function () {
            var product = this.getResponse();
            product.render();
        };
        return ResponseAJAX;
    }());
    exports.ResponseAJAX = ResponseAJAX;
    var CreateSuccessFully = /** @class */ (function (_super) {
        __extends(CreateSuccessFully, _super);
        function CreateSuccessFully() {
            return _super !== null && _super.apply(this, arguments) || this;
        }
        CreateSuccessFully.prototype.getResponse = function () {
            return new button_1.SuccessFully();
        };
        return CreateSuccessFully;
    }(ResponseAJAX));
    exports.CreateSuccessFully = CreateSuccessFully;
    var CreateExceed = /** @class */ (function (_super) {
        __extends(CreateExceed, _super);
        function CreateExceed() {
            return _super !== null && _super.apply(this, arguments) || this;
        }
        CreateExceed.prototype.getResponse = function () {
            return new button_1.Exceed();
        };
        return CreateExceed;
    }(ResponseAJAX));
    exports.CreateExceed = CreateExceed;
    var CreateNotAllowed = /** @class */ (function (_super) {
        __extends(CreateNotAllowed, _super);
        function CreateNotAllowed() {
            return _super !== null && _super.apply(this, arguments) || this;
        }
        CreateNotAllowed.prototype.getResponse = function () {
            return new button_1.NotAllowed();
        };
        return CreateNotAllowed;
    }(ResponseAJAX));
    exports.CreateNotAllowed = CreateNotAllowed;
    var CreateInternalError = /** @class */ (function (_super) {
        __extends(CreateInternalError, _super);
        function CreateInternalError() {
            return _super !== null && _super.apply(this, arguments) || this;
        }
        CreateInternalError.prototype.getResponse = function () {
            return new button_1.InternalError();
        };
        return CreateInternalError;
    }(ResponseAJAX));
    exports.CreateInternalError = CreateInternalError;
});
//# sourceMappingURL=response.js.map
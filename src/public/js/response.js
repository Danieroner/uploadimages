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
    var ResponseAjax = /** @class */ (function () {
        function ResponseAjax() {
        }
        ResponseAjax.prototype.someOperation = function () {
            var product = this.getResponse();
            product.render();
        };
        return ResponseAjax;
    }());
    exports.ResponseAjax = ResponseAjax;
    var CreateSuccessfully = /** @class */ (function (_super) {
        __extends(CreateSuccessfully, _super);
        function CreateSuccessfully() {
            return _super !== null && _super.apply(this, arguments) || this;
        }
        CreateSuccessfully.prototype.getResponse = function () {
            return new button_1.Successfully();
        };
        return CreateSuccessfully;
    }(ResponseAjax));
    exports.CreateSuccessfully = CreateSuccessfully;
    var CreateExceed = /** @class */ (function (_super) {
        __extends(CreateExceed, _super);
        function CreateExceed() {
            return _super !== null && _super.apply(this, arguments) || this;
        }
        CreateExceed.prototype.getResponse = function () {
            return new button_1.Exceed();
        };
        return CreateExceed;
    }(ResponseAjax));
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
    }(ResponseAjax));
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
    }(ResponseAjax));
    exports.CreateInternalError = CreateInternalError;
});
//# sourceMappingURL=response.js.map
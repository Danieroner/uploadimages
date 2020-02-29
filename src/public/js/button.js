define(["require", "exports", "./elements"], function (require, exports, elements_1) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    var SuccessFully = /** @class */ (function () {
        function SuccessFully() {
        }
        SuccessFully.prototype.render = function () {
            elements_1.response.innerHTML = "\n            <div class=\"card-panel light-blue darken-1\">\n                <span class=\"white-text text-darken-2\">\n                    <h5>The image was successfully uploaded</h5>\n                </span>\n            </div>";
            setTimeout(function () { return location.href = '/'; }, 700);
        };
        return SuccessFully;
    }());
    exports.SuccessFully = SuccessFully;
    var Exceed = /** @class */ (function () {
        function Exceed() {
        }
        Exceed.prototype.render = function () {
            elements_1.response.innerHTML = "\n            <div class=\"card-panel yellow lighten-1\">\n                <span class=\"black-text text-darken-2\">\n                    <h5>The image cannot exceed 5 mb</h5>\n                </span>\n            </div>";
        };
        return Exceed;
    }());
    exports.Exceed = Exceed;
    var NotAllowed = /** @class */ (function () {
        function NotAllowed() {
        }
        NotAllowed.prototype.render = function () {
            elements_1.response.innerHTML = "\n            <div class=\"card-panel yellow lighten-1\">\n                <span class=\"black-text text-darken-2\">\n                    <h5>This format is not allowed, only .jpg .png .gif</h5>\n                </span>\n            </div>";
        };
        return NotAllowed;
    }());
    exports.NotAllowed = NotAllowed;
    var InternalError = /** @class */ (function () {
        function InternalError() {
        }
        InternalError.prototype.render = function () {
            elements_1.response.innerHTML =
                "<div class=\"card-panel deep-orange accent-4\">\n                <span class=\"white-text text-darken-2\">\n                    <h5>Internal Error</h5>\n                </span>\n            </div>";
        };
        return InternalError;
    }());
    exports.InternalError = InternalError;
});
//# sourceMappingURL=button.js.map
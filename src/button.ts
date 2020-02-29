import { response } from './elements';

export default interface iResponse {
    render(): void;
}

export  class SuccessFully implements iResponse {
    public render(): void {
        response.innerHTML = `
            <div class="card-panel light-blue darken-1">
                <span class="white-text text-darken-2">
                    <h5>The image was successfully uploaded</h5>
                </span>
            </div>`;
        setTimeout(() => location.href = '/', 700);
    }
}

export  class Exceed implements iResponse {
    public render(): void {
        response.innerHTML = `
            <div class="card-panel yellow lighten-1">
                <span class="black-text text-darken-2">
                    <h5>The image cannot exceed 5 mb</h5>
                </span>
            </div>`;
    }
}

export  class NotAllowed implements iResponse {
    public render(): void {
        response.innerHTML = `
            <div class="card-panel yellow lighten-1">
                <span class="black-text text-darken-2">
                    <h5>This format is not allowed, only .jpg .png .gif</h5>
                </span>
            </div>`;
    }
}

export class InternalError implements iResponse {
    public render(): void {
        response.innerHTML = 
            `<div class="card-panel deep-orange accent-4">
                <span class="white-text text-darken-2">
                    <h5>Internal Error</h5>
                </span>
            </div>`;
    }
}
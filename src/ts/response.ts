import iResponse, { Successfully, Exceed, NotAllowed, InternalError } from './button';

export abstract class ResponseAjax {
    public abstract getResponse(): iResponse;

    public someOperation() {
        const product = this.getResponse();
        product.render();
    }
}

export class CreateSuccessfully extends ResponseAjax {
    public getResponse(): iResponse {
        return new Successfully();
    }
}

export class CreateExceed extends ResponseAjax {
    public getResponse(): iResponse {
        return new Exceed();
    }
}

export class CreateNotAllowed extends ResponseAjax {
    public getResponse(): iResponse {
        return new NotAllowed();
    }
}

export class CreateInternalError extends ResponseAjax {
    public getResponse(): iResponse {
        return new InternalError();
    }
}
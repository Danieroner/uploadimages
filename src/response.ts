import iResponse, { Successfully, Exceed, NotAllowed, InternalError } from './button';

export abstract class ResponseAJAX {
    public abstract getResponse(): iResponse;

    public someOperation() {
        const product = this.getResponse();
        product.render();
    }
}

export class CreateSuccessfully extends ResponseAJAX {
    public getResponse(): iResponse {
        return new Successfully();
    }
}

export class CreateExceed extends ResponseAJAX {
    public getResponse(): iResponse {
        return new Exceed();
    }
}

export class CreateNotAllowed extends ResponseAJAX {
    public getResponse(): iResponse {
        return new NotAllowed();
    }
}

export class CreateInternalError extends ResponseAJAX {
    public getResponse(): iResponse {
        return new InternalError();
    }
}
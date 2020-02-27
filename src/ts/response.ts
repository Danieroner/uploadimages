import iResponse, { Successfully, Exceed, NotAllowed, InternalError } from './button';

export default abstract class ResponseAjax {
    public abstract getResponse(): iResponse;

    public someOperation() {
        const product = this.getResponse();
    }
}

class CreateSuccessfully extends ResponseAjax {
    public getResponse(): iResponse {
        return new Successfully();
    }
}

class CreateExceed extends ResponseAjax {
    public getResponse(): iResponse {
        return new Exceed();
    }
}

class CreateNotAllowed extends ResponseAjax {
    public getResponse(): iResponse {
        return new NotAllowed();
    }
}

class CreateInternalError extends ResponseAjax {
    public getResponse(): iResponse {
        return new InternalError();
    }
}
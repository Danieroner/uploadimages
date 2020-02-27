import { button } from './elements';
import ResponseAjax from './response';


function run(response: ResponseAjax) {
    response.someOperation();
}

function makeRun() {
    console.log('functiona!!!');
}

function windowLoad() {
    button.addEventListener('click', makeRun);
}

window.addEventListener('load', windowLoad);
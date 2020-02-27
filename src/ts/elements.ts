export const form: HTMLFormElement | any = document.forms.namedItem('form');
export const button: HTMLElement | any = document.getElementById('send-data');

export const request: XMLHttpRequest = new XMLHttpRequest();

export const formData: FormData = new FormData(form);

export let response = <HTMLElement>document.getElementById('response');
export let load: HTMLElement | any = document.getElementById('load');
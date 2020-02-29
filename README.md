# UploadImages

Little app for uploading files.
Technologies used:
  - Php 7.4
  - Typescript
  - Bramus Router
  - Twig
 
### Installation

requires [Node.js](https://nodejs.org/) v8+ to run.
requires [Php.net] 7.4+ to run.

- composer
- npm

# Important

Check out the Storage class and change 'public.images' to your table name, and your table must have 'id, title, description, url, image' columns. But of course.. you can change it.

Install the dependencies and start the server.

```sh
$ php composer.phar install
$ npm install
$ tsc
$ npm run script start:dev
```

# Licence

MIT
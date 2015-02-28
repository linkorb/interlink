# Interlink: Advanced hyperlinking across services

Interlink let's you define custom link handlers for wiki links.

Some example:

Translate `[[wikipedia:Hello world]]` into:
```html
<a href="http://www.wikipedia.org/Hello_world" target="_blank">
    Hello world
</a>
```

Translate `[[wikihow:Grow an Orange Tree]]` into:
```html
<a href="http://www.wikihow.com/Grow-an-Orange-Tree">
    Grow an Orange Tree
</a>
```

Translate `[[mozilla-bugzilla:441207]]` into:
```html
<a href="https://bugzilla.mozilla.org/show_bug.cgi?id=441207">
    Printing selection causes blank page with header/footer only
</a>
```

Translate `[[mytaskdb:14]]` into:
```html
<a href="https://intranet.example.web/task/14">
    Redesign widgets to optimize alignment with KPI's
</a>
```

Using Interlink, you define `Handlers` for link prefixes (Like above: 'wikihow', or 'mytaskdb').
The handler can then automatically translate the link into a working bit of HTML using one of the available `Renderers`.

You can even create your own Renderer if the provided ones are not sufficient.

You can also pass a `LabelResolver` to your handler to translate the code or id into a userfriendly text.
For example, look up a task title in the database using PDO, based on the id in the link.
Or make a REST API call to a webservice to convert a bugid into a readable summary.

## How to use Interlink in your application

Simply add the following to your `require` or `require-dev` section in your [composer.json](http://getcomposer.org) and run `composer update`:
```json
"require": {
  "linkorb/haigha": "~1.0"
}
```

## Examples:

Please refer to the `examples/` directory for some simple and advanced examples.

## License

MIT (see [LICENSE.md](LICENSE.md))

## Brought to you by the LinkORB Engineering team

<img src="http://www.linkorb.com/d/meta/tier1/images/linkorbengineering-logo.png" width="200px" /><br />
Check out our other projects at [linkorb.com/engineering](http://www.linkorb.com/engineering).

Btw, we're hiring!

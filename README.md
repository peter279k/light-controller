# Usage

```bash
composer require lee/light-controller
```

```php
require_once './vendor/autoload.php';

use lee\Light;

$light = new Light('event_name', 'ifttt-webhook-maker-service-key');
$light->sendRequest(); // GuzzleHttp\Psr7\Response;
```

# References

- https://ifttt.com/maker_webhooks

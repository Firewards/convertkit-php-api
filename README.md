# ConvertKit PHP
Unofficial ConvertKit PHP API for [v3](https://api.convertkit.com/v3/).

This package makes it simple to access ConvertKit's web API. Checkout [https://developers.convertkit.com](https://developers.convertkit.com) for more information on ConvertKit's API.

[![Source Code](https://img.shields.io/badge/source-convertkit--php--api-blue)](https://github.com/Firewards/convertkit-php-api)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/Firewards/convertkit-php-api/blob/master/LICENSE)

## Install

Via Composer

``` bash
$ composer require firewards/convertkit-php-api
```

## Requirements

The following versions of PHP are supported.

* PHP 5.6
* PHP 7.0
* PHP 7.1
* PHP 7.2
* PHP 7.3

### API Key
All API calls require an API Key. You can find your API Key in the ConvertKit Account page.

### API Secret
Some API calls require an API Secret. All calls that require the api key will also work with the api secret, there's no need to use both. This key grants access to sensitive data and actions on your subscribers.

## Usage
Start by using ConvertKit API and creating an instance with your ConvertKit API key
```php
$api = new \Firewards\Apis\ConvertKit($api_key, $api_secret);
```
### Examples

**Get all Subscribers**

Get all subscribers using pagination.
```php
$i = 0;
while ($subscribers = $api->getSubscribers($i++))
{
    if (!isset($subscribers->subscribers) || count($subscribers->subscribers) === 0)
    {
        break;
    }
    
    var_dump($subscribers);
}
```

**Get all Custom Fields**

```php
$customFields = $api->getCustomFields();
```

**Create a Custom Field**

```php
$lastNameField = $api->createCustomField('last_name');
```

**Update subscriber**

Updates a subscriber and adds info to a custom field 'last_name'.

```php
$subscriberId = '1234';
$lastNameField = $api->updateSubscriber($subscriberId, ['last_name' => 'Stücken']);
```

**Get Tags**

Retrieve all tags.

```php
$tags = $api->getTags();
```

**Add Subscriber to Tag**

Adds a subscriber to a specific tag.

```php
$added = $api->addSubscriberToTag($tagId, $email);
```

**Subscribe to a form**

Add a subscriber to a form. The `$subscribed` response will be an object.

```php
$tag_id = '99999'; // This tag must be valid for your ConvertKit account.

$options = [
			'email'      => 'test@test.com',
			'name'       => 'Full Name',
			'first_name' => 'First Name',
			'tags'       => $tag_id,
			'fields'     => [
				'phone' => 134567891243,
				'shirt_size' => 'M',
				'website_url' => 'testurl.com'
			]
		];

$subscribed = $api->form_subscribe($this->test_form_id, $options);
```

**Get Subscriber ID**

Get the ConvertKit Subscriber ID for a given email address.

```php
$subscriber_id = $api->get_subscriber_id( $email );
```

**Get Subscriber**

Get subscriber data for a ConvertKit Subscriber.

```php
$subscriber = $api->get_subscriber( $subscriber_id );
```

**Get Subscriber Tags**

Get all tags applied to a Subscriber.

```php
$subscriber_tags = $api->get_subscriber_tags( $subscriber_id );
```

**Add Tag to a Subscriber**

Apply a tag to a Subscriber.

```php
$tag_id = '99999'; // This tag must be valid for your ConvertKit account.
$api->add_tag(tag_id, [
			'email' => 'test@test.com'
		]);
```

### Rate limiting

Please note that ConvertKit is rate limiting requests by 120 requests per minute.
If your request rate exceeds the limit, ConvertKit PHP Api will throw a *RateLimitExcededException*.

## Contributing

Please see [CONTRIBUTING](https://github.com/thephpleague/oauth2-client/blob/master/CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](https://github.com/thephpleague/oauth2-client/blob/master/LICENSE) for more information.

## Sponsor

This package is sponsored by [www.firewards.com](https://www.firewards.com), Firewards makes it easy to setup a referral and rewards program for your email list and newsletter.
